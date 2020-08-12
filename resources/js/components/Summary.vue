<template>
    <section class="bg-dark-blue">
        <div class="container mx-auto py-10 flex justify-between">
            <div class="flex items-center">
                <h1 class="text-2xl font-display text-white tracking-wider mr-4">Your Balance</h1>
                <Button name="Add Entry" icon="add" custom-class="h-3" />
                <Button name="Import CSV" icon="import" custom-class="h-7 transform -translate-y-2" />
            </div>

            <div class="font-body text-right">
                <p class="text-gray-500 uppercase tracking-wide">Total Balance</p>
                <p class="text-4xl text-green">$1,725.<span>00</span></p>
            </div>
        </div>
    </section>
</template>

<script>
    import Button from './Button.vue';

    export default {
      components: {
        Button,
      },
    }
</script>
