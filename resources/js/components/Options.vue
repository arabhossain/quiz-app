<template>
    <div class="mt-3">
        <p v-if="questionType !== 3 || questionType !== 4">Please select the correct answer</p>
        <template v-for="(option, index) in options">
            <template v-if="questionType === 1">
                <label v-if="option.image" class="text-center">
                    <input v-model="singleValue"  :value="option.id" class="image-radio" name="option" type="radio">
                    <img v-if="option.image" :src="'/'+option.image" style="max-height: 70px"/><br>
                    <span v-if="option.option">{{ option.option }}</span>
                </label>
                <label v-else>
                    <input v-model="singleValue"  :value="option.id" name="option" type="radio">
                    <span v-if="option.option">{{ option.option }}</span>
                </label>
            </template>

            <template v-if="questionType === 2">
                <label v-if="option.image">
                    <input v-model="multipleValue" :value="option.id" type="checkbox">
                    <img v-if="option.image" :src="'/'+option.image" style="max-height: 70px"/>
                    <span v-if="option.option" class="float-left">{{ option.option }}</span>
                </label>
                <label v-else>
                    <input v-model="multipleValue" :value="option.id" type="checkbox">
                    <span v-if="option.option">{{ option.option }}</span>
                </label>
            </template>
        </template>

        <template v-if="questionType === 3">
            <div class="form-group">
                <label for="answer">Answer</label>
                <input type="text" class="form-control" id="answer"  v-model="textAnswer" placeholder="Type your answer here...">
            </div>
        </template>

        <template v-if="questionType === 4">
            <div class="form-group">
                <label for="answer">Place correct answer(s)</label>
                <div v-html="fillGaps"></div>
            </div>
        </template>

    </div>
</template>

<script>
export default {
    props: ['options', 'questionId', 'questionType', 'fillGaps'],
    data() {
        return {
            textAnswer: null,
            singleValue: null,
            multipleValue: [],
        }
    },
    watch: {
        textAnswer(newValue, oldValue) {
            if (newValue !== oldValue)
                this.selectOption();
        },
        singleValue(newValue, oldValue) {
            if (newValue !== oldValue)
                this.selectOption();
        },
        multipleValue(newValue, oldValue) {
            if (newValue !== oldValue)
                this.selectOption();
        },
        getFillInGaps(){
            if (!this.fillGaps)
                return;


        }
    },
    methods: {
        selectOption(optionId) {
            let emitData = {
                questionId: this.questionId,
                questionType: this.questionType
            };

            if (this.questionType === 3){
                emitData['answer'] = this.textAnswer;
            }

            if (this.questionType === 2){
                emitData['answer'] = this.multipleValue;
            }

            if (this.questionType === 1){
                emitData['answer'] = this.singleValue;
            }

            this.$emit('selected',emitData)
        },
    }
}
</script>

<style scoped>
/* HIDE RADIO */
.image-radio[type=radio] {
    position: absolute;
    opacity: 0;
    width: 0;
    height: 0;
}

/* IMAGE STYLES */
.image-radio[type=radio] + img {
    cursor: pointer;
}

/* CHECKED STYLES */
.image-radio[type=radio]:checked + img {
    outline: 2px solid #f00;
}
</style>
