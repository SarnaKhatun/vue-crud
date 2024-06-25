<template>
    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="text-center">Students</h4>
                            <router-link class="btn btn-primary float-end" v-bind:to="{name: 'student-add'}">Add Student</router-link>
                        </div>
                        <div class="card-body mt-4">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Address</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody v-if="this.students.length > 0">
                                <tr v-for="(student, key) in this.students" :key="key">
                                    <td>{{student.id}}</td>
                                    <td>{{student.name}}</td>
                                    <td>{{student.address}}</td>
                                    <td>{{student.email}}</td>
                                    <td>{{student.phone}}</td>
                                    <td>
                                        <router-link class="btn btn-info" v-bind:to="{name: 'student-edit', params: {id: student.id}}">Edit</router-link>
                                        <button type="button" v-on:click="deleteStudent(student.id)" class="btn btn-danger mx-2">Delete</button>
                                    </td>
                                </tr>
                                </tbody>
                                <tbody v-else>
                                <tr>
                                    <td colspan="6">Loading.....</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
    import axios from 'axios'
    export default {
        name: 'StudentView',
        data() {
            return {
                students: [],
            }
        },
        mounted() {
            this.getStudents();
            // console.log('hello');
        },
        methods: {
            getStudents(){
                axios.get('http://127.0.0.1:8000/api/student').then(res => {
                    this.students = res.data.students;
                    // console.log(this.students);
                });
            },
            deleteStudent(studentId) {
                if (confirm('Are you sure want to delete this data??'))
                {
                    // console.log(studentId);
                    axios.delete(`http://127.0.0.1:8000/api/student/delete/${studentId}`).then( res => {
                        alert(res.data.message);
                        this.getStudents();
                    })
                        .catch(function (error) {
                            if (error.response) {
                                if (error.response.status == 404) {
                                    alert(error.response.data.message);
                                }

                            }
                        });
                }
            },
        },
    }
</script>

<style scoped>

</style>