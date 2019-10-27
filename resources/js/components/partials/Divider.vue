<template>
    <div>
        <h2 v-if="title">{{title}}</h2>
        <img src="images/divider_cyan.png" alt="divider_cyan">
        <p v-if="description">{{description}}</p>
    </div>
</template>

<script>
export default {
    props: {
        title: {
            default: ""
        },
        description: {
            default: ""
        }
    }
}
</script>