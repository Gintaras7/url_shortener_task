<script setup></script>

<template>
    <div class="error-message">
        <slot />
    </div>
</template>

<style scoped>
.error-message {
    position: absolute;
    color: #c12121;
    padding-top: 4px;
    padding-left: 22px;
}
</style>
