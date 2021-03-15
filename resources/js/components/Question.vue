<template>
    <div class="row">
       <div class="col">
           <div class="row" v-if="getQuestion">
               <div class="col">
                   <div class="float-right">{{ currentQuestionIndex +1 }} of {{ questionCount }} Questions</div>
                   <h3 v-if="getQuestion.question">{{ getQuestion.question }}</h3>
                   <p v-if="getQuestion.description" v-html="getQuestion.description"></p>
                   <img style="max-height: 250px" v-if="getQuestion.image" :src="getImage(getQuestion.image)" alt="">
                   <q-options @selected="answered" v-if="currentQuestion || getQuestion.answer_type === 3" :answers="answers" :questionType="getQuestion.answer_type" :questionId="getQuestion.id" :options="getQuestion.options"/>
               </div>
           </div>
           <div class="row">
               <div class="col">
                   <button :disabled="!isNotMinNumberOfQuestion" @click="backQuestion" class="btn btn-warning">Back</button>
                   <button :disabled="!isNotMaxNumberOfQuestion" @click="nextQuestion" class="btn btn-success">Next</button>
                   <button v-if="!isNotMaxNumberOfQuestion" @click="submitQuiz" class="btn btn-primary">Submit</button>
               </div>
           </div>
       </div>
    </div>
</template>

<script>

import Options from "./Options";

export default {
    props: ['quiz', 'user', 'baseUrl'],
    components:{
        'q-options' : Options
    },
    data(){
        return {
            answers: [],
            tempAnswer: null,
            currentQuestion: null,
            currentQuestionIndex: null,
        }
    },
    computed: {
        questions: function () {
            return this.quiz.questions || []
        },
        questionCount() {
            return this.questions.length;
        },
        submitable(){
            return false
        },
        getQuestionIds(){
            let ids = [];
            for (const question of this.questions)
                if (question.id)
                    ids.push(question.id)
            return ids;
        },
        getQuestion(){
            if (this.currentQuestionIndex !== null)
               return this.questions[this.currentQuestionIndex]

            return null
        },
        isNotMaxNumberOfQuestion(){
            return this.currentQuestionIndex < this.questionCount - 1;
        },
        isNotMinNumberOfQuestion(){
            return this.currentQuestionIndex > 0
        }
    },
    mounted() {
        if (this.getQuestionIds[0]){
            this.currentQuestion = this.getQuestionIds[0]
            this.currentQuestionIndex = 0;
        }
        console.log(this.quiz)
    },
    methods: {
        getOptions(questionId) {
            for (const question of this.questions)
                if (question.id === questionId)
                    return question.options

            return []
        },
        getImage(path){
            return '/'+path
        },
        nextQuestion(){
            if (this.isNotMaxNumberOfQuestion){
                this.currentQuestionIndex++
            }

        },
        backQuestion(){
            if (this.isNotMinNumberOfQuestion){
                this.currentQuestionIndex--
            }
        },
        answered(answer){
            for (const ans of this.answers)
                if (ans.questionId === answer.questionId){
                    const index = this.answers.indexOf(ans)
                    if (index > -1) {
                        this.answers.splice(index, 1);
                    }
                }

            this.answers.push(answer)
        },
        submitQuiz(){
            let data = []
            data['answers'] = this.answers;
            data['quiz_id'] = this.quiz.id

            console.log(data)
        },
    }
}
</script>
