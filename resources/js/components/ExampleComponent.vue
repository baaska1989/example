<template>
    <div class="w-full grid grid-cols-2 gap-2">
        <div class="border-green-700 border">
            <div class="mx-auto p-5" v-if="students.length">
                <table class="w-full border-collapse">
                    <tr>
                        <td>#</td>
                        <td>Овог</td>
                        <td>Нэр</td>
                        <td>Төрсөн огноо</td>
                        <td>Үйлдэл</td>
                    </tr>
                    <tr v-for="student in students">
                        <td>{{ student.id }}</td>
                        <td>{{ student.last_name }}</td>
                        <td>{{ student.first_name }}</td>
                        <td>{{ student.birth_date }}</td>
                    </tr>
                </table>
            </div>
            <div v-else class="w-full text-red-700 text-center">
                Мэдээлэл байхгүй
            </div>
        </div>
        <div class="border border-sky-600 px-20 py-10">
            <div class="w-full text-center text-lg mb-5">
                Сурагчийн Мэдээлэл оруулах
            </div>
            <div class="mb-2 w-full">
                <label>Сурагчийн овог</label>
                <input
                    v-model="last_name"
                    type="text"
                    class="h-8 w-96 ml-2 px-3 border"
                    placeholder="Сурагчийн овог"
                />
            </div>
            <div class="mb-2 w-full">
                <label>Сурагчийн нэр</label>
                <input
                    v-model="first_name"
                    type="text"
                    class="h-8 w-96 ml-2 px-3 border"
                    placeholder="Сурагчийн овог"
                />
            </div>
            <div class="mb-2 w-full">
                <label>Хүйс</label>
                <select class="h-8 w-96 ml-2 px-3 border" v-model="gender">
                    <option value="1">Эрэгтэй</option>
                    <option value="0">Эмэгтэй</option>
                </select>
            </div>
            <div class="mb-2 w-full">
                <label>Төрсөн он сар өдөр</label>
                <input
                    v-model="birth_date"
                    type="date"
                    class="h-8 w-60 ml-2 px-3 border"
                    placeholder="Сурагчийн овог"
                />
            </div>
            <div class="mb-2 w-full">
                <label>Анги</label>
                <select class="h-8 w-60 ml-2 px-3 border" v-model="angi">
                    <option value="1a">1a</option>
                    <option value="2a">2a</option>
                    <option value="3a">3a</option>
                    <option value="4a">4a</option>
                    <option value="5a">5a</option>
                    <option value="6a">6a</option>
                    <option value="7a">7a</option>
                    <option value="8a">8a</option>
                    <option value="9a">9a</option>
                    <option value="10a">10a</option>
                    <option value="11a">11a</option>
                    <option value="12a">12a</option>
                </select>
            </div>

            <button
                @click="saveStudents()"
                class="bg-sky-800 px-10 float-right py-2 text-white"
            >
                Хадгалах
            </button>
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
            last_name: "",
            first_name: "",
            gender: null,
            birth_date: "",
            angi: null,
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
        saveStudents() {
            axios
                .post("/saveStudents", {
                    first_name: this.first_name,
                    last_name: this.last_name,
                    gender: this.gender,
                    birth_date: this.birth_date,
                    angi: this.angi,
                })
                .then(({ data }) => {
                    if (data.status) {
                        this.getStudent();
                        (this.first_name = ""),
                            (this.last_name = ""),
                            (this.gender = null),
                            (this.angi = null),
                            (this.birth_date = "");
                    } else {
                        alert("Хадгалж чадсангүй");
                    }
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
                    axios.get("/delete/" + value).then(({ data }) => {
                        if (data.status) {
                            this.getStudent();
                        }
                    });
                }
            });
        },
    },

    mounted() {
        console.log("Component mounted. text");
    },
};
</script>
