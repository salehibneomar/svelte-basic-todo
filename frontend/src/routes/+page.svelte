<script lang="ts">
	export let data: { todos: any[] }
	let todos = [...data.todos]
</script>

<div class="mx-auto mt-10 max-w-xl rounded-lg bg-white p-8 shadow-lg">
	<h1 class="mb-6 text-center text-3xl font-bold text-slate-800">Todo List</h1>

	<form class="mb-6 flex gap-2">
		<input
			type="text"
			placeholder="Add a new todo..."
			class="flex-1 rounded border border-slate-300 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-slate-400"
		/>
		<button
			type="submit"
			class="cursor-pointer rounded bg-slate-600 px-4 py-2 text-white hover:bg-slate-800"
		>
			Add
		</button>
	</form>

	<ul class="space-y-3">
		{#each todos as todo}
			<li
				class="flex items-center justify-between rounded bg-slate-100 px-4 py-2 transition-colors hover:bg-slate-200"
			>
				<div class="flex items-center gap-2">
					<input type="checkbox" class="ml-2 accent-slate-700" checked={todo.is_completed} />
					<span class={todo.is_completed ? 'text-slate-400 line-through' : 'text-slate-700'}>{todo.title}</span>
				</div>
				<button class="cursor-pointer text-red-500 hover:text-red-700" aria-label="Delete todo">
					<i class="fa-solid fa-trash"></i>
				</button>
			</li>
		{/each}
	</ul>

	<!-- Pagination -->
	<nav class="mt-8 flex justify-center" aria-label="Pagination">
		<ul class="inline-flex items-center -space-x-px text-sm">
			<li>
				<a
					href="#"
					class="ms-0 flex h-8 items-center justify-center rounded-s border border-e-0 border-slate-300 bg-white px-2 leading-tight text-slate-500 hover:bg-slate-100 hover:text-slate-700"
					>Previous</a
				>
			</li>
			<li>
				<a
					href="#"
					class="flex h-8 items-center justify-center border border-slate-300 bg-white px-2 leading-tight text-slate-500 hover:bg-slate-100 hover:text-slate-700"
					>1</a
				>
			</li>
			<li>
				<a
					href="#"
					class="flex h-8 items-center justify-center border border-slate-300 bg-white px-2 leading-tight text-slate-500 hover:bg-slate-100 hover:text-slate-700"
					>2</a
				>
			</li>
			<li>
				<a
					href="#"
					class="flex h-8 items-center justify-center border border-slate-300 bg-white px-2 leading-tight text-slate-500 hover:bg-slate-100 hover:text-slate-700"
					>3</a
				>
			</li>
			<li>
				<a
					href="#"
					class="flex h-8 items-center justify-center rounded-e border border-slate-300 bg-white px-2 leading-tight text-slate-500 hover:bg-slate-100 hover:text-slate-700"
					>Next</a
				>
			</li>
		</ul>
	</nav>
</div>
