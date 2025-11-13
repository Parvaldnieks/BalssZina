@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-orange-500 focus:ring-indigo-500 dark:focus:ring-red-500 rounded-md shadow-sm']) }}>
