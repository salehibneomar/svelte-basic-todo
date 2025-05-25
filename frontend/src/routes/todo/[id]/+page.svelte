<script lang="ts">
	import { onMount } from 'svelte'
	import { page } from '$app/state'
	import todoStore from '$lib/stores/todo-store'
	import { utcToLocalDateTime } from '$lib/helpers'

	const paramTodoId = page.params.id

	let { todo } = todoStore

	let loading = true
	onMount(async () => {
		await todoStore.getById(paramTodoId)
		loading = false
	})
</script>

<div class="mx-auto mt-16 flex max-w-lg flex-col gap-8 rounded-xl bg-white p-8 shadow-xl">
	{#if !loading}
		{#if $todo}
			<h1 class="mb-0 text-center text-lg font-extrabold tracking-tight text-slate-900">
				{$todo.title}
			</h1>

			<div class="mt-0 flex flex-col items-center justify-between gap-4 sm:flex-row sm:gap-8">
				<div class="flex items-center gap-2">
					{#if $todo.is_completed}
						<i class="fa-solid fa-check-circle text-base text-green-500"></i>
					{:else}
						<i class="fa-solid fa-xmark text-base text-red-500"></i>
					{/if}
					<span class="text-sm font-medium {$todo.is_completed ? 'text-green-700' : 'text-red-600'}"
						>{$todo.is_completed ? 'Completed' : 'Not completed'}</span
					>
				</div>
				<div class="flex flex-col gap-1 text-xs text-slate-500">
					<div>
						<span class="font-semibold">Created:</span>
						<span>{utcToLocalDateTime($todo.created_at ?? '')}</span>
					</div>
					<div>
						<span class="font-semibold">Updated:</span>
						<span>{utcToLocalDateTime($todo.updated_at ?? '')}</span>
					</div>
				</div>
			</div>
		{:else}
			<p class="text-center text-slate-500">Todo not found.</p>
		{/if}
	{:else}
		<p class="text-center text-slate-500">Loading todos...</p>
	{/if}
</div>
