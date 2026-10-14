<script setup >
const props = defineProps({
    modelValue: {
        type: [String, Number]
    },
    padding_class: "p-2"
});
defineEmits(['update:modelValue']);
</script>
<template>
    <select :value="modelValue" v-on:change="$emit('update:modelValue', $event.target.value)" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#878787] focus:border-[#878787] block w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#878787] dark:focus:border-[#878787] uppercase"
    :class="[padding_class]">
        <slot></slot>
    </select>

</template>
