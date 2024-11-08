<template>
    <div class="w-full">
        <div class="mx-auto">
            <div
                v-for="student in students"
                class="text-lg ml-20 flex justify-between mb-1"
            >
                <div class="text-red-500">{{ student.first_name }}</div>
                <div class="ml-5 text-blue-800">{{ student.last_name }}</div>
                <div
                    @click="alert1(student.first_name)"
                    class="bg-stone-600 rounded-lg ml-10 px-3 py-1 text-white"
                >
                    Дэлгэрэнгүй
                </div>
                <button
                    @click="userDelete(student.id)"
                    class="bg-red-600 rounded-lg ml-10 px-3 py-1 text-white"
                >
                    Устгах
                </button>
            </div>
        </div>
    </div>
</template>

<script>
import Swal from "sweetalert2/dist/sweetalert2.js";
import "sweetalert2/src/sweetalert2.scss";
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
        alert1(value) {
            alert("Сайн байна уу  " + value);
        },
        userDelete(value) {
            Swal.fire({
                title: "Та устгахдаа итгэлтэй байна уу?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Тийм!",
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.get('/delete/' + value).then(({data}) => {
                        if(data.status)
                        {
                            this.getStudent();
                        }
                    })
                }
            });
        },
    },

    mounted() {
        console.log("Component mounted.");
    },
};
</script>
