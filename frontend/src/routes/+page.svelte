<script lang="ts">
	import { onMount } from 'svelte'
	import todoStore from '$lib/stores/todo-store'
	import type { PaginationModel } from '$lib/types/pagination'
	import type { TodoBaseModel } from '$lib/types/todo'

	let { todos } = todoStore

	let pagingData: PaginationModel = {
		current_page: 1,
		per_page: 10
	} as PaginationModel

	let formData: TodoBaseModel = {
		title: ''
	}

	let loading = true
	onMount(async () => {
		await getAllTodos()
		loading = false
	})

	const syncPagingData = (data: PaginationModel) => {
		pagingData = { ...pagingData, ...data }
	}

	const getAllTodos = async () => {
		const response = await todoStore.getAll()
		if (response) {
			const { current_page, per_page, last_page, from, to, total } = response
			syncPagingData({ current_page, per_page, last_page, from, to, total })
		}
	}

	let submitting = false
	const onSubmitForm = async () => {
		submitting = true
		const response = await todoStore.create(formData)
		if (response) {
			formData.title = ''
		}
		submitting = false
	}

	let deletingId: number | null = null
	const onDeleteTodo = async (id: number) => {
		deletingId = id
		const response = await todoStore.remove(id)
		deletingId = null
	}
</script>

<div class="mx-auto mt-10 max-w-xl rounded-lg bg-white p-8 shadow-lg">
	{#if !loading}
		<h1 class="mb-6 text-center text-3xl font-bold text-slate-800">Todo List</h1>

		<form class="mb-6 flex gap-2" on:submit|preventDefault={onSubmitForm}>
			<input
				type="text"
				placeholder="Add a new todo..."
				class="flex-1 rounded border border-slate-300 px-4 py-2 focus:ring-2 focus:ring-slate-400 focus:outline-none"
				required
				minlength="3"
				pattern="^(?!\s+$).+"
				bind:value={formData.title}
				disabled={submitting}
			/>
			<button
				type="submit"
				class="cursor-pointer rounded bg-slate-600 px-4 py-2 text-white hover:bg-slate-800"
				disabled={submitting}
			>
				Add
			</button>
		</form>

		{#if $todos.length === 0}
			<p class="text-center text-slate-500">No todos found!</p>
		{:else}
			<ul class="space-y-3">
				{#each $todos as todo}
					<li
						class="flex items-center justify-between rounded bg-slate-100 px-4 py-2 transition-colors hover:bg-slate-200"
					>
						<div class="flex items-center gap-2">
							<input
								type="checkbox"
								class="ml-2 accent-slate-700"
								checked={Boolean(todo?.is_completed)}
							/>
							<span class={todo?.is_completed ? 'text-slate-400 line-through' : 'text-slate-700'}
								>{todo?.title}</span
							>
						</div>
						<button
							on:click|capture={() => onDeleteTodo(todo?.id as number)}
							class="cursor-pointer text-red-500 hover:text-red-700"
							aria-label="Delete todo"
							disabled={deletingId === todo?.id}
						>
							<i class="fa-solid fa-trash"></i>
						</button>
					</li>
				{/each}
			</ul>

			{#if pagingData.total > pagingData.per_page}
				<nav class="mt-8 flex justify-center" aria-label="Pagination">
					<ul class="inline-flex items-center -space-x-px text-sm">
						<li>
							<button
								type="button"
								class="ms-0 flex h-8 items-center justify-center rounded-s border border-e-0 border-slate-300 bg-white px-2 leading-tight text-slate-500 transition-colors hover:bg-slate-100 hover:text-slate-700 focus:ring-2 focus:ring-slate-400 focus:outline-none"
							>
								Previous
							</button>
						</li>

						{#each Array(pagingData.last_page) as _, index}
							<li>
								<button
									type="button"
									class="flex h-8 cursor-pointer items-center justify-center border border-slate-300 px-2 leading-tight transition-colors focus:ring-2 focus:ring-slate-400 focus:outline-none
							{+pagingData.current_page === index + 1
										? 'bg-slate-600 font-bold text-white'
										: 'bg-white text-slate-500 hover:bg-slate-100 hover:text-slate-700'}"
								>
									{index + 1}
								</button>
							</li>
						{/each}

						<li>
							<button
								type="button"
								class="flex h-8 items-center justify-center rounded-e border border-slate-300 bg-white px-2 leading-tight text-slate-500 transition-colors hover:bg-slate-100 hover:text-slate-700 focus:ring-2 focus:ring-slate-400 focus:outline-none"
							>
								Next
							</button>
						</li>
					</ul>
				</nav>
			{/if}
		{/if}
	{:else}
		<p class="text-center text-slate-500">Loading todos...</p>
	{/if}
</div>
