<script setup>
defineProps({
	modelValue: {
        type: String
    },
	padding_class: "p-2"
});
defineEmits(['update:modelValue']);
</script>

<template>
	<input type="text" :value="modelValue" @input="$emit('update:modelValue', $event.target.value)"
	class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-[#878787] focus:border-[#878787] block w-full dark:bg-gray-700 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#878787] dark:focus:border-[#878787]" :class="[padding_class]" >
</template>
	