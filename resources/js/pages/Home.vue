<template>
    <div>
        <Nav />
        <Summary />

        <div class="container mx-auto">
            <h1>Mob Psycho</h1>
        </div>
    </div>
</template>

<script>
    import Summary from '../components/Summary.vue';
    import Nav from '../components/Nav.vue';

    export default {
      components: {
        Summary,
        Nav
      },
    }
</script>
