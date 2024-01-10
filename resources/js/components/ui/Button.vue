<script setup>
import { defineProps } from 'vue';

defineProps({
    disabled: Boolean,
    type: {
        default: 'button',
        validator(value) {
            return ['submit', 'button'].includes(value);
        },
    },
});

defineEmits(['click']);
</script>

<template>
    <button
        data-testid="button"
        class="button"
        @click.prevent="$emit('click')"
        :class="{
            disabled: disabled,
        }"
        :disabled="disabled"
    >
        <slot />
    </button>
</template>

<style scoped>
.button {
    background-color: #3ab969;
    color: white;
    font-size: 1.5rem;
    padding: 4px 8px;
    height: 68px;
    width: 140px;
    border: 0;
    cursor: pointer;
    transition: opacity 0.1s ease;
}

.disabled {
    opacity: 0.7;
    cursor: default;
}
</style>
