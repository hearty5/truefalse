<template>
  <div class="text-center animated fadeInRight">
    <div class="h2 mb-5">True or False</div>
    <div>
      
        <div v-if="page >= 1 && page != 11">
          <div class="progress mb-5">
            <div
            class="progress-bar bg-success"
            role="progressbar"
            v-bind:style="styleObject"
            aria-valuenow="10"
            aria-valuemin="0"
            aria-valuemax="100"
            ></div>
          </div>
          <div class="mx-auto">
            <div class="pl-5 mb-5">
              <p class="text-muted mt-2 text-left">Question {{ page }}</p>
              <p class="h4 text-left">{{ quizQuestion }}</p>
            </div>

            <ul class="list-unstyled text-left ml-5" style="margin-left: 3rem">
              <li class="mb-2">
                <button
                  style="background: none; border: none"
                  :disabled="clicked"
                  @click="answerA"
                >
                  <span
                    class="btn btn-primary mr-2"
                    :class="{
                      active: activeBtn === 'btn1',
                      correct: correctBtn === 'btn1',
                      incorrect: incorrectBtn === 'btn1',
                    }"
                    >T</span
                  >
                  <span class="text-muted">True</span>
                </button>
              </li>
              <li class="mb-2">
                <button
                  style="background: none; border: none"
                  :disabled="clicked"
                  @click="answerB"
                >
                  <span
                    class="btn btn-primary mr-2"
                    :class="{
                      active: activeBtn === 'btn2',
                      correct: correctBtn === 'btn2',
                      incorrect: incorrectBtn === 'btn2',
                    }"
                    >F</span
                  >
                  <span class="text-muted">False</span>
                </button>
              </li>
            </ul>
          </div>
        </div>
      </transition>
    </div>

    <div class="svg-box" v-show="show">
      <svg class="circular green-stroke">
        <circle
          class="path"
          cx="75"
          cy="75"
          r="50"
          fill="none"
          stroke-width="5"
          stroke-miterlimit="10"
        />
      </svg>
      <svg class="checkmark green-stroke">
        <g
          transform="matrix(0.79961,8.65821e-32,8.39584e-32,0.79961,-489.57,-205.679)"
        >
          <path
            class="checkmark__check"
            fill="none"
            d="M616.306,283.025L634.087,300.805L673.361,261.53"
          />
        </g>
      </svg>
    </div>

    <div class="svg-box" v-show="incorrect">
      <svg class="circular red-stroke">
        <circle
          class="path"
          cx="75"
          cy="75"
          r="50"
          fill="none"
          stroke-width="5"
          stroke-miterlimit="10"
        />
      </svg>
      <svg class="cross red-stroke">
        <g
          transform="matrix(0.79961,8.65821e-32,8.39584e-32,0.79961,-502.652,-204.518)"
        >
          <path
            class="first-line"
            d="M634.087,300.805L673.361,261.53"
            fill="none"
          />
        </g>
        <g
          transform="matrix(-1.28587e-16,-0.79961,0.79961,-1.28587e-16,-204.752,543.031)"
        >
          <path class="second-line" d="M634.087,300.805L673.361,261.53" />
        </g>
      </svg>
    </div>
  </div>
</template>

<script>
import axios from "axios";
import swal from "sweetalert";

export default {
  data() {
    return {
      quiz: "",
      page: 1,
      question: "",
      x: "",
      activeTab: 0,
      answer: "",
      activeBtn: "",
      correctBtn: "",
      incorrectBtn: "",
      clicked: false,
      nextClicked: true,
      answersContainer: [],
      correctAnswers: 0,
      id: 1,
      show: false,
      incorrect: false,
    };
  },
  computed: {
    styleObject: function () {
      return {
        width: this.page * 10 + "%",
      };
    },
    quizQuestion: function () {
      return this.quiz["q" + this.page];
    },
  },
  created() {
    this.getQuiz();
  },
  methods: {
    getQuiz() {
      axios
        .get("/truefalse/" + this.id)
        .then((resp) => (this.quiz = resp.data.data))
        .catch((err) => console.log(err.response.data));
    },
    answerA() {
      if (this.clicked) {
        return;
      }

      this.clicked = true;
      this.answer = "a";
      this.activeBtn = "btn1";
      this.submitAnswer();
    },
    answerB() {
      if (this.clicked) {
        return;
      }
      this.clicked = true;
      this.answer = "b";
      this.activeBtn = "btn2";
      this.submitAnswer();
    },
    submitAnswer() {
      axios
        .put("/truefalse", {
          answer: this.answer,
          id: this.id,
          question: this.page,
        })
        .then((response) => {
          this.correctBtn = response.data.data;
          if (response.data.message == "Correct!") {
            this.show = true;
            setTimeout(() => {
              this.show = false;
              this.clicked = false;
            }, 2000);
          }
          if (response.data.message != "Correct!") {
            this.incorrect = true;
            this.incorrectBtn = this.activeBtn;
            this.answersContainer.push(this.page);
            setTimeout(() => {
              this.incorrect = false;
            }, 2000);
            setTimeout(() => {
              this.page++;
              this.activeBtn = "";
              this.incorrectBtn = "";
              this.correctBtn = "";
              this.clicked = false;
            }, 2000);
            if (this.answersContainer.length === 10) {
              setTimeout(() => {
                swal("Your score is " + this.correctAnswers * 10 + " %");
              }, 2000);
            }
            return;
          }
          this.correctAnswers++;
          this.answersContainer.push(this.page);
          setTimeout(() => {
            this.page++;
            this.activeBtn = "";
            this.correctBtn = "";
          }, 2000);
          if (this.answersContainer.length === 10) {
            setTimeout(() => {
              swal("Your score is " + this.correctAnswers * 10 + " %");
            }, 2000);
          }
        })
        .catch((err) => {
          if (err.response) {
            console.log("Unable to update event!", err.response.data);
            swal("Unable to update event!");
            this.clicked = false;
          }
        });
    },
    /*     nextPage() {
      this.page++;
      this.correctBtn = "";
      this.clicked = false;
      this.activeBtn = "";
      this.incorrectBtn = "";
      this.nextClicked = true;
    }, */
  },
};
</script>

<style>
.correct {
  color: #fff;
  background-color: #28a745 !important;
  border-color: #28a745 !important;
}
.incorrect {
  color: #fff;
  background-color: #c82333 !important;
  border-color: #bd2130 !important;
}
.swal-footer {
  text-align: center;
}

.svg-box {
  display: inline-block;
  position: relative;
  width: 150px;
  margin: 0;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
}

.green-stroke {
  stroke: #7cb342;
}

.red-stroke {
  stroke: #ff6245;
}

.circular circle.path {
  stroke-dasharray: 330;
  stroke-dashoffset: 0;
  stroke-linecap: round;
  opacity: 0.4;
  animation: 0.7s draw-circle ease-out;
}

/*------- Checkmark ---------*/
.checkmark {
  stroke-width: 6.25;
  stroke-linecap: round;
  position: absolute;
  top: 56px;
  left: 49px;
  width: 52px;
  height: 40px;
}

.checkmark path {
  animation: 1s draw-check ease-out;
}

@keyframes draw-circle {
  0% {
    stroke-dasharray: 0, 330;
    stroke-dashoffset: 0;
    opacity: 1;
  }

  80% {
    stroke-dasharray: 330, 330;
    stroke-dashoffset: 0;
    opacity: 1;
  }

  100% {
    opacity: 0.4;
  }
}

@keyframes draw-check {
  0% {
    stroke-dasharray: 49, 80;
    stroke-dashoffset: 48;
    opacity: 0;
  }

  50% {
    stroke-dasharray: 49, 80;
    stroke-dashoffset: 48;
    opacity: 1;
  }

  100% {
    stroke-dasharray: 130, 80;
    stroke-dashoffset: 48;
  }
}

/*---------- Cross ----------*/

.cross {
  stroke-width: 6.25;
  stroke-linecap: round;
  position: absolute;
  top: 54px;
  left: 54px;
  width: 40px;
  height: 40px;
}

.cross .first-line {
  animation: 0.7s draw-first-line ease-out;
}

.cross .second-line {
  animation: 0.7s draw-second-line ease-out;
}

@keyframes draw-first-line {
  0% {
    stroke-dasharray: 0, 56;
    stroke-dashoffset: 0;
  }

  50% {
    stroke-dasharray: 0, 56;
    stroke-dashoffset: 0;
  }

  100% {
    stroke-dasharray: 56, 330;
    stroke-dashoffset: 0;
  }
}

@keyframes draw-second-line {
  0% {
    stroke-dasharray: 0, 56;
    stroke-dashoffset: 0;
  }

  50% {
    stroke-dasharray: 0, 56;
    stroke-dashoffset: 0;
  }

  100% {
    stroke-dasharray: 56, 330;
    stroke-dashoffset: 0;
  }
}
</style>