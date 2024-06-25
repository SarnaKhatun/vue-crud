<template>
    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 mx-auto">
                    <div class="card">
                        <div class="card-header">
                            <h4>Student Edit Form</h4>
                        </div>
                        <div class="card-body">
                            <ul class="alert alert-warning" v-if="Object.keys(this.errorList).length > 0">
                                <li class="mb-0 ms-3" v-for="(error, index) in this.errorList" :key="index">
                                    {{ error[0] }}
                                </li>
                            </ul>
                            <div class="form-group">
                                <label>Student name:</label>
                                <input type="text" v-model="model.student.name" class="form-control"  placeholder="Student name">

                            </div>
                            <div class="form-group mt-lg-2">
                                <label>Student Address:</label>
                                <input type="text" v-model="model.student.address"  class="form-control"  placeholder="Student Address">

                            </div>
                            <div class="form-group mt-lg-2">
                                <label>Student Email:</label>
                                <input type="email"  class="form-control" v-model="model.student.email" placeholder="Student Email">

                            </div>

                            <div class="form-group mt-lg-2">
                                <label>Phone:</label>
                                <input type="text" v-model="model.student.phone"  class="form-control"  placeholder="Phone">

                            </div>

                            <button type="button" @click="updateStudent(student)" class="btn btn-primary mt-lg-2">Save</button>
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
        name: "StudentEditFormView",
        data(){
            return {
                studentId: '',
                errorList: '',
                model: {
                    student: {
                        name: '',
                        address: '',
                        email: '',
                        phone: '',
                    }
                }
            }
        },
        mounted() {
            // console.log(this.$route.params.id);
            this.studentId = this.$route.params.id;
            this.getStudentData(this.$route.params.id);
        },
        methods: {
            getStudentData(studentId) {

                axios.get(`http://127.0.0.1:8000/api/student/edit/${studentId}`).then(res => {
                    // console.log(res.data.student);
                    this.model.student = res.data.student;
                })
                    .catch(function (error) {
                        if (error.response) {
                            if (error.response.status == 404) {
                                alert(error.response.data.message);
                            }

                        }
                    });
            }
            ,
            updateStudent() {
                var mythis = this;
                axios.put(`http://127.0.0.1:8000/api/student/update/${this.studentId}`, this.model.student).then( res => {
                    console.log(res.data);
                    alert(res.data.message);

                    this.model.student = {
                        name: '',
                        address: '',
                        email: '',
                        phone: '',
                    }
                    this.errorList = '';
                })
                    .catch(function (error) {
                        if (error.response) {
                            if (error.response.status == 422) {
                                mythis.errorList = error.response.data.errors;
                            }
                            if (error.response.status == 404) {
                                alert(error.response.data.message);
                            }

                        }
                        else if(error.request) {
                            console.log(error.request);
                        }
                        else {
                            console.log('Error', error.message);
                        }
                    });
            }
        },
    }
</script>

<style scoped>

</style>