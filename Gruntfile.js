module.exports = function(grunt) {
	grunt.initConfig({
		pkg: grunt.file.readJSON('package.json'),
		sass: {
			dist: {
				files: [{
					expand: true,
					cwd: 'public/themes/magazine/style',
					src: ['**/*.scss'],
					dest: 'public/themes/magazine/style',
					ext: '.css'
				}]
			}
		},
		watch: {
			css: {
				files: ['**/*.scss'],
				tasks: ['sass']
			},
			reload: {
				files: ['**/*.blade.php','**/*.scss'],
				tasks: ['reload']
			},
			options: {
		      forever: true,
		    },
		},
	});

	grunt.loadNpmTasks('grunt-contrib-watch');
	grunt.loadNpmTasks('grunt-contrib-sass');

	grunt.registerTask('watchreload', ['watch:css', 'watch:reload']);
	grunt.registerTask('default',['watch:css']);

	grunt.registerTask("reload", "reload Chrome on OS X",
	function() {
		require("child_process").exec("osascript " +
			"-e 'tell application \"Google Chrome\" " +
			"to tell the active tab of its first window' " +
			"-e 'reload' " +
			"-e 'end tell'");
	});
};