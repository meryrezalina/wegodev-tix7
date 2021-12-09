<template>
    <div>
        <div class="form-group form-row" v-for="(schedule, index) in schedules">
            <div class="col-11">
                <input type="text" class="form-control" name="schedule[][]" v-model="schedule.hour" placeholder="Hour">
            </div>
            <div class="c0l-1">
                <button type="button" @click="removeSchedule(index)" class="btn btn-outline-danger"><i class="fas fa-times"></i></button>
            </div>
        </div>
        <div class="text-center">
            <button type="button" @click="addSchedule" class="btn btn-secondary btn-sm"><i class="fas fa-calendar-alt"></i> Add Schedule</button>
        </div>
    </div>
</template>

<script>
    export default {
        data: () => ({
            schedules: []
        }),
        methods: {
            addSchedule(){
                this.schedules.push({
                    hour: ''
                })
            },
            removeSchedule(index){
                this.schedules.splice(index, 1)
            }
        }
    }
</script>
