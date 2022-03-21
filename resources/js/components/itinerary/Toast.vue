<template>
  <div>
    <b-alert
      :show="dismissCountDown"
      dismissible
      fade
      variant="warning"
      @dismiss-count-down="countDownChanged"
    >
      This alert will dismiss after {{ dismissCountDown }} seconds...
    </b-alert>
     <b-button @click="showAlert();" variant="info" class="m-1">
    </b-button>
  </div>
</template>

<script>
export default {
  props: {
    message: {
      type: String,
      default: ''
    }
  },
  data() {
    return {
      dismissSecs: 4,
      dismissCountDown: 0,
    }
  },
  methods: {
    countDownChanged(dismissCountDown) {
        this.dismissCountDown = dismissCountDown
      },
    showAlert() {
      this.dismissCountDown = this.dismissSecs
    }
  }
}
</script>
