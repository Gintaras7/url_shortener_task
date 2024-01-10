<script setup>
import Button from '@/components/ui/Button.vue';
import InputField from '@/components/ui/InputField.vue';
import ErrorMessage from '@/components/ui/ErrorMessage.vue';
import GeneratedLinkResult from './GeneratedLinkResult.vue';
import { useShortener } from '@/composables/use-shortener.js';

const {
    form,
    isBusy,
    response,
    errors,
    canSubmitForm,
    hasResponse,
    hasError,
    submit,
    clearRequestErrors,
} = useShortener();
</script>

<template>
    <div class="shortener__container">
        <span class="title">Enter URL</span>
        <form class="form__container">
            <div>
                <InputField
                    v-model="form.url"
                    type="text"
                    @inputChanged="clearRequestErrors()"
                />
                <ErrorMessage v-show="!canSubmitForm && !isBusy">
                    URL must follow https://example.org pattern
                </ErrorMessage>
            </div>

            <Button @click="submit()" :disabled="!canSubmitForm">
                Shorten
            </Button>
        </form>

        <ErrorMessage v-if="hasError"> {{ errors.message }}</ErrorMessage>

        <GeneratedLinkResult
            v-if="hasResponse"
            class="generated-link__container"
            :link="response?.shortened_link"
        />
    </div>
</template>
<style scoped>
.shortener__container {
    font-family: monospace;
    color: #333333;
    margin: auto;
    padding-top: 100px;
    width: 800px;
}

span.title {
    font-size: 2rem;
    padding-left: 18px;
}

.form__container {
    display: grid;
    grid-template-columns: 1fr auto;
    align-items: end;
    padding-top: 20px;
}

.generated-link__container {
    margin-top: 100px;
}
</style>
