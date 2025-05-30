<script lang="ts">
	import { onMount } from 'svelte'
	import todoStore from '$lib/stores/todo-store'
	import type { PaginationModel } from '$lib/types/pagination'
	import type { QueryObject } from '$lib/types/query'
	import type { TodoBaseModel, TodoModel } from '$lib/types/todo'
	import { Button, Modal } from "flowbite-svelte";
  	import { ExclamationCircleOutline } from "flowbite-svelte-icons";

	import TodoListItem from '$lib/components/todo/TodoListItem.svelte'

	let { todos } = todoStore

	let pagingData: PaginationModel = $state({
		current_page: 1,
		per_page: 10,
		last_page: 1
	} as PaginationModel)

	let formData: TodoBaseModel = $state({
		title: ''
	})

	let loading = $state(true)
	onMount(async () => {
		await getAllTodos()
		loading = false
	})

	const syncPagingData = (data: PaginationModel) => {
		pagingData = { ...pagingData, ...data }
	}

	const getAllTodos = async (query: QueryObject = {} as QueryObject) => {
		const response = await todoStore.getAll(query)
		if (response) {
			const { current_page, per_page, last_page, from, to, total } = response
			syncPagingData({ current_page, per_page, last_page, from, to, total })
		}
	}

	let submitting = $state(false)
	const onSubmitForm = async () => {
		submitting = true
		const response = await todoStore.create(formData)
		if (response) {
			formData.title = ''
		}
		submitting = false
	}

	const onTodoStatusChange = async (id: number, is_completed: boolean) => {
		const payload = {
			id,
			is_completed
		} as TodoModel
		await todoStore.update(payload)
	}

	let toBeDeletedTodoId : number | null = $state(null)
	let popupModal = $state(false)
	const onTodoDelete = async (id: number) => {
		toBeDeletedTodoId = id
		popupModal = true
		
	}

	const deleteTodo = async() => {
		await todoStore.remove(toBeDeletedTodoId as number)
	}

	const onPaginationChange = async (page : number) => {
		await getAllTodos({page} as QueryObject)
	}

</script>

<div class="mx-auto mt-10 max-w-xl rounded-lg bg-white p-8 shadow-lg">
	{#if !loading}
		<h1 class="mb-6 text-center text-3xl font-bold text-slate-800">Todo List</h1>

		<form class="mb-6 flex gap-2" onsubmit={onSubmitForm}>
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
					<TodoListItem
						todo={todo}
						onStatusChange={onTodoStatusChange}
						onDelete={onTodoDelete}
					/>
				{/each}
			</ul>

			{#if pagingData.total > pagingData.per_page}
				<nav class="mt-8 flex justify-center" aria-label="Pagination">
					<ul class="inline-flex items-center -space-x-px text-sm">
						<li>
							<button
								type="button"
								class="ms-0 flex h-8 items-center justify-center rounded-s border border-e-0 border-slate-300 bg-white px-2 leading-tight text-slate-500 transition-colors hover:bg-slate-100 hover:text-slate-700 focus:ring-2 focus:ring-slate-400 focus:outline-none"
								onclick={()=>{onPaginationChange(pagingData.current_page-1)}}
								disabled={pagingData.current_page === 1}
							>
								<span aria-hidden="true">Previous</span>
							</button>
						</li>

						{#each Array(pagingData.last_page), index}
							<li>
								<button
									type="button"
									class="flex h-8 cursor-pointer items-center justify-center border border-slate-300 px-2 leading-tight transition-colors focus:ring-2 focus:ring-slate-400 focus:outline-none
							{+pagingData.current_page === index + 1
										? 'bg-slate-600 font-bold text-white'
										: 'bg-white text-slate-500 hover:bg-slate-100 hover:text-slate-700'}"
										onclick={()=>{onPaginationChange(index+1)}}
								>
									{index + 1}
								</button>
							</li>
						{/each}

						<li>
							<button
								type="button"
								class="flex h-8 items-center justify-center rounded-e border border-slate-300 bg-white px-2 leading-tight text-slate-500 transition-colors hover:bg-slate-100 hover:text-slate-700 focus:ring-2 focus:ring-slate-400 focus:outline-none"
								onclick={()=>{onPaginationChange(pagingData.current_page+1)}}
								disabled={+pagingData.last_page === +pagingData.current_page}
							>
								<span aria-hidden="true">Next</span>
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

<Modal bind:open={popupModal} size="xs" autoclose>
  <div class="text-center">
    <ExclamationCircleOutline class="mx-auto mb-4 h-12 w-12 text-gray-400 dark:text-gray-200" />
    <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">
		Are you sure you want to delete?
	</h3> 
	<Button  onclick={deleteTodo} color="red" class="cursor-pointer me-2" >Okay</Button>
	<Button color="alternative" class="cursor-pointer">Cancel</Button>
  </div>
</Modal>
