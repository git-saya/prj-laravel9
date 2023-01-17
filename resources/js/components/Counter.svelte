<script>
  let count = 0

  const increment = () => {
    count += 1
  }
</script>

<p>Count: {count}</p>
<button on:click={increment}>+1</button>

<style>

</style>