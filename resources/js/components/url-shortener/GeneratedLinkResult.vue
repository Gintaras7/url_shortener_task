<script setup>
defineProps({
    link: String,
});
</script>

<template>
    <div>
        <span class="title">Shortened URL</span>
        <div class="link__container">
            {{ link }}
        </div>
    </div>
</template>

<style scoped>
span.title {
    font-size: 2rem;
    padding-left: 18px;
}

.link__container {
    color: #333333;
    font-family: monospace;
    font-size: 1.5rem;
    display: flex;
    align-items: center;
    background-color: white;
    height: 68px;
    user-select: all;
    margin-top: 20px;
    padding-left: 18px;
}
</style>
