module.exports = function(grunt) {
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
        sass: {
            development: {
                files: {
                    "./assets/css/style.css": "./assets/scss/style.scss",
                }
            }
        },
        watch: {
            files: "./assets/scss/**/*",
            tasks: ["sass"]
        }
    });

    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-contrib-sass');

    grunt.registerTask('default', ['watch']);

}
