<script lang="ts">
	import '../app.css'

	const { children } = $props()

	const getCurrentYear = (): string => {
		return new Date().getFullYear().toString()
	}
</script>

<svelte:head>
	<title>Todo App</title>
</svelte:head>

<div class="flex min-h-screen flex-col">
	<!-- Navigation Bar -->
	<nav class="bg-slate-700 p-4 text-white">
		<div class="container mx-auto flex justify-between">
			<a href="/" class="text-lg font-bold">Todo App</a>
		</div>
	</nav>

	<!-- Main Content -->
	<main class="container mx-auto flex-grow p-6">
		{@render children()}
	</main>

	<!-- Footer -->
	<footer class="mt-auto bg-slate-700 p-4 text-center text-white">
		<p>&copy; {getCurrentYear()} Todo App</p>
	</footer>
</div>
