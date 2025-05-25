<script lang="ts">
	import '../app.css'
	import { ToastContainer, FlatToast } from 'svelte-toasts'

	const { children } = $props()

	const getCurrentYear = (): string => {
		return new Date().getFullYear().toString()
	}
</script>

<svelte:head>
	<title>Todo App</title>
</svelte:head>

<div class="flex min-h-screen flex-col">
	<nav class="bg-slate-700 p-4 text-white">
		<div class="container mx-auto flex justify-between">
			<a href="/" class="text-lg font-bold">Todo App</a>
		</div>
	</nav>

	<main class="container mx-auto flex-grow p-6">
		<ToastContainer placement="bottom-center" theme="light" showProgress let:data>
			<div class="solid-toast">
				<FlatToast {data} />
			</div>
		</ToastContainer>
		{@render children()}
	</main>

	<footer class="mt-auto bg-slate-700 p-4 text-center text-white">
		<p>&copy; {getCurrentYear()} Todo App</p>
	</footer>
</div>

<style>
	.solid-toast {
		background-color: white !important;
		color: black !important;
		border: none;
	}
</style>
