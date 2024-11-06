<template>
    <div class="w-full">
        <div class="mx-auto">
            <div v-for="student in students" class="text-lg ml-20 flex">
                <div class="text-red-500">{{ student.first_name }}</div>
                <div class="ml-5 text-blue-800">{{ student.last_name }}</div>
                <div @click="alert1(student.first_name)" 
                class="bg-stone-600 rounded-lg ml-10 px-3 py-1 text-white">Товч</div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            students: [],
        };
    },
    created() {
        this.getStudent();
    },

    methods: {
        getStudent() {
            axios.get("/getStudents").then(({ data }) => {
                this.students = data.data;
            });
        },
        alert1(value)
        {
        alert('Сайн байна уу  ' + value)
        }
    },

    mounted() {
        console.log("Component mounted.");
    },
};
</script>
