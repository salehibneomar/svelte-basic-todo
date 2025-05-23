<script lang="ts">
	import { goto } from '$app/navigation'

	console.log(import.meta.env.VITE_SIO_API_BASE_URL)
	// Svelte page component
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
		<li
			class="flex items-center justify-between rounded bg-slate-100 px-4 py-2 transition-colors hover:bg-slate-200"
		>
			<input type="checkbox" class="mr-2 accent-slate-700" />
			<!-- Clickable link area -->
			<a href="/todo/1" class="flex flex-1 items-center">
				<span class="text-slate-700">Buy groceries</span>
			</a>

			<!-- Delete button outside the link -->
			<button class="ml-4 cursor-pointer text-red-500 hover:text-red-700" aria-label="Delete todo">
				<i class="fa-solid fa-trash"></i>
			</button>
		</li>
		<li
			class="flex items-center justify-between rounded bg-slate-100 px-4 py-2 transition-colors hover:bg-slate-200"
		>
			<div class="flex items-center gap-2">
				<input type="checkbox" class="ml-2 accent-slate-700" checked />
				<span class="text-slate-400 line-through">Read a book</span>
			</div>
			<button class="cursor-pointer text-red-500 hover:text-red-700" aria-label="Delete todo">
				<i class="fa-solid fa-trash"></i>
			</button>
		</li>
		<li
			class="flex items-center justify-between rounded bg-slate-100 px-4 py-2 transition-colors hover:bg-slate-200"
		>
			<div class="flex items-center gap-2">
				<input type="checkbox" class="ml-2 accent-slate-700" />
				<span class="text-slate-700">Walk the dog</span>
			</div>
			<button class="cursor-pointer text-red-500 hover:text-red-700" aria-label="Delete todo">
				<i class="fa-solid fa-trash"></i>
			</button>
		</li>
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
