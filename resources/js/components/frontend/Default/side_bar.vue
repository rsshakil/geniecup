<template>
  <!-- Main Sidebar -->
  <!-- main-sidebar -->
  <aside class="main-sidebar" style="position: absolute; top: -60px">
    <div class="main-navbar">
      <nav
        class="navbar align-items-stretch navbar-light bg-white flex-md-nowrap border-bottom p-0"
      >
        <router-link to="/" class="nav-link" style="line-height: 25px">
          <div class="d-table m-auto">
            <img
              id="main-logo"
              class="d-inline-block align-top mr-1"
              style="max-width: 25%"
              :src="BASE_URL + '/public/backend/images/logo/jacos_logo.png'"
              alt="Jacos Dashboard"
            />
            <span class="d-none d-md-inline ml-1">{{ myLang.heading }}</span>
          </div>
        </router-link>
        <a class="toggle-sidebar d-sm-inline d-md-none d-lg-none">
          <i class="material-icons">&#xE5C4;</i>
        </a>
      </nav>
    </div>
    <form
      action="#"
      class="main-sidebar__search w-100 border-right d-sm-flex d-md-none d-lg-none"
    >
      <div class="input-group input-group-seamless ml-3">
        <div class="input-group-prepend">
          <div class="input-group-text">
            <i class="fas fa-search"></i>
          </div>
        </div>
        <input
          class="navbar-search form-control"
          type="text"
          placeholder="Search for something..."
          aria-label="Search"
        />
      </div>
    </form>
    <div class="nav-wrapper">
      <ul class="nav flex-column">
        <li class="nav-item" v-can="['dashboard_menu']">
          <a
            class="nav-link collapsed"
            href="#dashboardmenu1"
            data-toggle="collapse"
            data-target="#dashboardmenu1"
            ><b-icon icon="gear-fill" font-scale="1.2"></b-icon>
            Admin Setup</a
          >
          <div class="collapse" id="dashboardmenu1" aria-expanded="false">
            <ul class="flex-column pl-2 nav">
              <li class="nav-item" v-can="['dashboard_menu']">
                <router-link to="/home" class="nav-link">
                  <b-icon icon="house-fill" font-scale="1.2"></b-icon> {{ myLang.dashboard_text }}
                </router-link>
              </li>
              <li class="nav-item" v-can="['role_menu']">
                <router-link to="/role" class="nav-link">
                  <b-icon icon="person-check-fill" font-scale="1.2"></b-icon>
                  {{ myLang.role_management }}
                </router-link>
              </li>
              <li class="nav-item" v-can="['permission_menu']">
                <router-link to="/permission" class="nav-link">
                  <b-icon icon="person-bounding-box" font-scale="1.2"></b-icon>
                  {{ myLang.permission_management }}
                </router-link>
              </li>
              <li class="nav-item" v-can="['assign_role_to_user_menu']">
                <router-link to="/assign_role_to_user" class="nav-link">
                  <b-icon icon="folder-symlink-fill" font-scale="1.2"></b-icon>
                  {{ myLang.assign_role_to_user }}
                </router-link>
              </li>
              <li class="nav-item" v-can="['assign_permission_to_user_menu']">
                <router-link to="/assign_permission_to_user" class="nav-link">
                  <b-icon icon="unlock-fill" font-scale="1.2"></b-icon>
                  {{ myLang.assign_permission_to_user }}
                </router-link>
              </li>
              <li class="nav-item" v-can="['manage_user_menu']">
                <router-link to="/users" class="nav-link">
                  <b-icon icon="person-circle" font-scale="1.2"></b-icon>
                  {{ myLang.manage_users }}
                </router-link>
              </li>
            </ul>
          </div>
        </li>
      </ul>
    </div>
  </aside>
</template>

<script>
export default {
  name: "sidebar",
  props: ["app"],
  data() {
    return {
      csrf: document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content"),
    };
  },
  methods: {
    logout: function () {
      axios
        .post("logout")
        .then((response) => {
          if (response.status === 302 || 401) {
            console.log("logout");
          } else {
            // throw error and go to catch block
          }
        })
        .catch((error) => {});
    },
  },
};
</script>