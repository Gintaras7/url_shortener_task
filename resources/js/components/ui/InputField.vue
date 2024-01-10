<script setup>
import { defineEmits, defineProps } from 'vue';

defineProps({
    label: String,
    inputClass: String,
    modelValue: String | Number,
    type: {
        validator(value) {
            return ['text', 'number'].includes(value);
        },
    },
});

const emit = defineEmits(['update:modelValue', 'inputChanged']);
const update = (event) => {
    emit('update:modelValue', event.target.value);
    emit('inputChanged', event.target.value);
};
</script>

<template>
    <label class="input__wrapper-label" data-testid="label">
        {{ label }}<br />
        <input
            data-testid="input"
            :class="[inputClass, ' input__wrapper-input']"
            :value="modelValue"
            @input="update"
            :type="type"
        />
    </label>
</template>

<style scoped>
.input__wrapper-label {
    display: flex;
}

.input__wrapper-input {
    width: 100%;
    padding: 8px 22px;
    height: 50px;
    font-size: 2rem;
    border: 1px solid #3ab969;
    color: #333333;
}

.input__wrapper-input:focus {
    outline: none;
}
</style>
