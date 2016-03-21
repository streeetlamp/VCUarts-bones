module.exports = function(grunt) {

    // 1. All configuration goes here
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),

        // Grunt-sass
        sass: {
          app: {
            files: [{
              expand: true,
              cwd: 'library/scss',
              src: ['*.scss'],
              dest: 'library/css',
              ext: '.css'
            }]
          },
          options: {
            sourceMap: false,
            outputStyle: 'nested',
            imagePath: "library/images",
          }
        },

        watch: {
            scss: {
                files: ['library/scss/**/*.scss'],
                tasks: ['sass', 'autoprefixer']
            },
            css: {
                files: ['library/css/**/*.css']
            },
            js: {
                files: ['library/js/**/*.js','!library/js/dist/main.js','!library/js/dist/main.min.js'],
                tasks: ['concat']
            },
            livereload: {
                files: ['**/*.html', '**/*.php', '**/*.js', '**/*.css', '!**/node_modules/**'],
                options: { livereload: true }
            }
        },

        autoprefixer: {
            options: {
                map: false
            },
            dist: {
                files: {
                    'library/css/main.css' : 'library/css/main.css'
                }
            }
        },

        cssmin: {
            combine: {
                files: {
                    'library/css/main.min.css': 'library/css/main.css',
                    'library/css/editor-style.min.css': 'library/css/editor-style.css'
                }
            }
        },

        jshint: {
            all: [
                'library/js/*.js',
            ],
            options: {
                jshintrc: 'library/js/.jshintrc'
            }
        },

        concat: {
            footer: {
                src: [
                    'library/js/libs/*.js', // All JS in the libs folder
                    'library/js/scripts.js',  // This specific file
                ],
                dest: 'library/js/dist/main.js',
            }
        },

        uglify: {
            footer: {
                src: 'library/js/dist/main.js',
                dest: 'library/js/dist/main.min.js'
            },
        },

        copy: {
            main: {
                files: [
                    {expand: true, src: ['**','!build/**','!bower_components/**','!node_modules/**','!.git/**','!library/scss/**','!bower.json','!package.json','!Gruntfile.js','!*.DS_store','.travis.yml'], dest: 'build/'},
                ],
            },
        },

        buildcontrol: {
          options: {
            dir: 'build',
            commit: true,
            push: true,
            message: 'Built from commit %sourceCommit% on branch %sourceBranch%'
          },
          local: {
            options: {
              remote: '../',
              branch: 'build'
            }
          }
        },

        clean: {
            build: {
                src: ['!build/.git/**', 'build/**/*']
            }
        },

        concurrent: {
            watch: {
                tasks: ['watch', 'sass'],
                options: {
                    logConcurrentOutput: true
                }
            }
        }
    });

    // 3. Where we tell Grunt what plugins to use

    // Sass
    grunt.loadNpmTasks('grunt-sass');
    grunt.loadNpmTasks('grunt-autoprefixer');
    grunt.loadNpmTasks('grunt-contrib-cssmin');

    // JS
    grunt.loadNpmTasks('grunt-contrib-jshint');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-concat');

    // Browser Reload + File Watch
    grunt.loadNpmTasks('grunt-concurrent');
    grunt.loadNpmTasks('grunt-contrib-watch');

    // Building
    grunt.loadNpmTasks('grunt-contrib-copy');
    grunt.loadNpmTasks('grunt-contrib-clean');
    grunt.loadNpmTasks('grunt-build-control');

    // 4. Where we tell Grunt what to do when we type "grunt" into the terminal.
    grunt.registerTask('dev', ['watch']);
    grunt.registerTask('build', ['sass', 'autoprefixer', 'cssmin', 'concat', 'uglify']);
    grunt.registerTask('deploy', ['build', 'clean', 'copy', 'buildcontrol']);
};