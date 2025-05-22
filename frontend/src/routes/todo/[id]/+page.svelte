<script lang="ts">
</script>

<!-- Todo Details Page HTML Only -->
<div class="mx-auto mt-16 flex max-w-lg flex-col gap-8 rounded-xl bg-white p-8 shadow-xl">
	<!-- Title at the very top -->
	<h1 class="mb-6 text-center text-3xl font-extrabold tracking-tight text-slate-900">Todo Item</h1>

	<!-- Description field -->
	<div>
		<label for="description" class="mb-1 block text-xs font-semibold text-slate-500"
			>Description</label
		>
		<div
			id="description"
			class="min-h-[48px] rounded-md border border-slate-200 bg-slate-50 px-4 py-3 text-slate-700"
		>
			Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla facilisi.
		</div>
	</div>

	<!-- Status, Created, Updated -->
	<div class="mt-2 flex flex-col items-center justify-between gap-4 sm:flex-row sm:gap-8">
		<div class="flex items-center gap-2">
			<i class="fa-solid fa-check-circle text-base text-green-500"></i>
			<span class="text-sm font-medium text-green-700">Completed</span>
		</div>
		<div class="flex flex-col gap-1 text-xs text-slate-500">
			<div>
				<span class="font-semibold">Created:</span>
				<span>2025-05-23 10:00:00</span>
			</div>
			<div>
				<span class="font-semibold">Updated:</span>
				<span>2025-05-23 12:00:00</span>
			</div>
		</div>
	</div>
</div>
