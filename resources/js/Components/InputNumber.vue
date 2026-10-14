<script setup>
defineProps({
	modelValue: {
        type: [Number, String]
    }
});
defineEmits(['update:modelValue']);
</script>

<template>
	<input type="number" :value="modelValue" @input="$emit('update:modelValue', $event.target.value)"
	class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#878787] focus:border-[#878787] block w-full p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#878787] dark:focus:border-[#878787] list-none">
</template>
