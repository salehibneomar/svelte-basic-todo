<script lang="ts">
  import { goto } from '$app/navigation'
  import type { TodoModel } from '$lib/types/todo'

  export let todo: TodoModel
  export let onStatusChange : (id: number, is_completed: boolean) => void
  export let onDelete : (id: number) => void

</script>

<li
  class="flex items-center justify-between rounded bg-slate-100 px-4 py-0 transition-colors hover:bg-slate-200"
>
  <input
    type="checkbox"
    class="accent-slate-700"
    checked={Boolean(todo?.is_completed)}
    on:change={(e) => {
      const isCompleted = (e.target as HTMLInputElement).checked;
      onStatusChange?.(todo?.id as number, isCompleted);
    }}
    tabindex="-1"
  />
  <button
    type="button"
    class="ml-3 flex flex-1 cursor-pointer items-center gap-2 border-none bg-transparent py-2 text-left focus:outline-none"
    on:click={() => goto(`/todo/${todo.id}`)}
  >
    <span class={todo?.is_completed ? 'text-slate-400 line-through' : 'text-slate-700'}>
      {todo?.title}
    </span>
  </button>
  <button
    on:click={() => onDelete?.(todo?.id as number)}
    class="cursor-pointer text-red-500 hover:text-red-700"
    aria-label="Delete todo"
  >
    <i class="fa-solid fa-trash"></i>
  </button>
</li>