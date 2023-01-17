<script>
  let name = 'svelte'
  import Counter from './Counter.svelte';
</script>

<h1>Hello, <span class="logo-font">{name}</span>.</h1>
<Counter />

<style>
  .logo-font {
    text-transform: lowercase;
    font-size:2.5rem;
    font-family: sans-serif;
    color: #aa1e1e;
  }
</style>