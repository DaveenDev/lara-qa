<template>
    
        <div class="col-md-12 mt-3" v-cloak v-if="count>0">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <h3>{{title}}</h3>
                            </div>
                            <hr>
                            <answer v-for="(answer,index) in answers" :answer="answer" :key="answer.id"
                                @deleted="remove(index)"></answer>

                            <div class="text-center mt-3">
                                <button v-if="nextUrl" 
                                    @click.prevent="fetch(nextUrl)"
                                    class="btn btn-outline-secondary">More...</button>        
                            </div>
                        </div>
                    
                    </div>
                    <new-answer :questionID="question.id" ></new-answer>
    </div>
    
    
</template>

<script>
import Answer from './Answer.vue';
import NewAnswer from './NewAnswer.vue';
import EventBus from './answer-events';

export default {
    props: ['question'],
    components: { Answer ,NewAnswer},
    data(){
        return{
        questionID: this.question.id,
        count: this.question.answers_count,
        answers: [],
        nextUrl: null
        }
    },
    created(){
        this.fetch(`/questions/${this.questionID}/answers`);
        EventBus.$on('postedAnswer', answer=>{
            this.answers.push(answer);
            this.count++;
        });
        
        EventBus.$on('editMode',()=>{

        });

    },
    methods:{
        fetch(endpoint){
            axios.get(endpoint)
                .then(res=>{
                    //... means merging data array with data, data3.push(...data1)
                    this.answers.push(...res.data.data);
                    this.nextUrl=res.data.next_page_url;
                });
        },    
        remove(index){
            this.answers.splice(index,1); //remove the deleted index
            this.count--;
          
        },
        newAnswerAdded(answer){
            this.answers.push(answer);
            this.count++;
        }
    },
    computed: {
        title(){
            return  this.count + " " + (this.count > 1? 'Answers' : 'Answer');
        }
    }
}
</script>