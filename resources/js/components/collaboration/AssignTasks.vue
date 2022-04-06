<template>
  <b-row>
      <div class="col-8">
        <div class="collaborate-users border p-3">
          <user v-for="user in users" :key="user.id">
            {{user.name}}
          </user>
        </div>
      </div>
  </b-row>
</template>

<script>
    import User from './User.vue'
    export default {
      components: {
        'user': User
      },
      // props: {
      //   options: {
      //     type: Array,
      //     default: [],
      //   }
      // },
      data() {
        return {
          users: [
            {
              id: 1,
              name: "Adrian Schubert",
              avatar: "https://pickaface.net/gallery/avatar/unr_sample_161118_2054_ynlrg.png"
            },
            {
              id: 2,
              name: "Violet Gates",
              avatar: "https://pickaface.net/gallery/avatar/freud51c8b3f65e7dc.png"
            },
            {
              id: 3,
              name: "Steve Jobs",
              avatar: "https://pickaface.net/gallery/avatar/Opi51c74d0125fd4.png"
            },
            {
              id: 4,
              name: "Yassine Smith",
              avatar: "https://pickaface.net/gallery/avatar/unr_yassine_191124_2012_3gngr.png"
            },
            {
              id: 5,
              name: "Senior Saez",
              avatar: "https://pickaface.net/gallery/avatar/elmedinilla541c03412955c.png"
            }
          ],
          newUsers: [],
          flights:[],
          hotels:[],
          excursions:[],
          other:[],
          errors: [],
          csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
      },
      methods: {
        
      }
    }
</script> 