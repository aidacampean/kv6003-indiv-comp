module.exports = {
    preset: '@vue/cli-plugin-unit-jest',
    collectCoverageFrom: [
      "./resources/js/components/**/*.vue"
    ],
    coverageDirectory: "./.coverage/js",
    collectCoverage: true,
  
    testEnvironment: "jsdom",
    testMatch: [
      "<rootDir>/tests/Vue/components/**/*.test.js"
    ],
    moduleFileExtensions: [
      "js",
      "json",
      // tell Jest to handle `*.vue` files
      "vue"
    ],
  
    transform: {
      ".*\\.(vue)$": "./node_modules/vue-jest",
      "^.+\\.js$": "./node_modules/babel-jest"
    },
  
    moduleNameMapper: {
      "^@/(.*)$": "<rootDir>/resources/js/components/$1"
    },
  
    setupFilesAfterEnv: [
      "<rootDir>tests/Vue/setup.js"
    ],
  }