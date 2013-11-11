module.exports = function(grunt){
    'use strict';
    
    // config
    var gruntConfig = {
        assets: {
            less: 'html/wp-content/themes/kremalicious2/assets/less',
            css: 'html/wp-content/themes/kremalicious2/assets/css',
            js: 'html/wp-content/themes/kremalicious2/assets/js',
            img: 'html/wp-content/themes/kremalicious2/assets/img'
        }
    };
    
    // banner
    grunt.log.writeln("");
    grunt.log.writeln("   <<<<<<<<<<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>>>>>>>>>>>>");
    grunt.log.writeln("");
    grunt.log.writeln("       Just what do you think you're doing, Matthias?    ");
    grunt.log.writeln("");
    grunt.log.writeln("   <<<<<<<<<<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>>>>>>>>>>>>");
    grunt.log.writeln("");
    
    // Grunt config
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
        config: gruntConfig,
        
        // less
        less: {
            dist: {
                files: {
                    '<%= config.assets.css %>/kremalicious2.min.css' : '<%= config.assets.less %>/kremalicious2.less',
                    '<%= config.assets.css %>/wp-admin.min.css' : '<%= config.assets.less %>/wp-admin.less',
                    '<%= config.assets.css %>/wp-login.min.css' : '<%= config.assets.less %>/wp-login.less',
                    '<%= config.assets.css %>/syntaxhighlighting.min.css' : '<%= config.assets.less %>/syntaxhighlighting.less'
                },
            },
        },
        
        // combine media queries in all css
        cmq: {
            options: {
                log: true
            },
            dist: {
                files: {
                    '<%= config.assets.css %>' : ['<%= config.assets.css %>/*.css']
                }
            }
        },
        
        // minify all css
        cssmin: {
            dist: {
                files: [
                    {
                        expand: true,
                        cwd: '<%= config.assets.css %>/',
                        src: ['*.css'],
                        dest: '<%= config.assets.css %>/',
                        ext: '.min.css'
                    }
                ]
            }
        },
        
        // Concatenate and minify js
        uglify: {
            dist: {
                options: {
                    report: 'min',
                    mangle: true
                },
                files: {
                    '<%= config.assets.js %>/kremalicious2.min.js': [                  
                        '<%= config.assets.js %>/libs/infinitescroll/jquery.infinitescroll.js',
                        '<%= config.assets.js %>/libs/socialite/socialite.js',
                        '<%= config.assets.js %>/bootstrap-tooltip.js',
                        '<%= config.assets.js %>/bootstrap-transition.js',
                        '<%= config.assets.js %>/plugins.js',
                        '<%= config.assets.js %>/script.js'
                    ]
                }
            }
        },
        
        // image optimization
        imagemin: {
            assets: {
                files: [
                    {
                        expand: true,
                        cwd: '<%= config.assets.img %>/',
                        src: ['**/*.{png,jpg,jpeg,gif}'],
                        dest: '<%= config.assets.img %>/'
                    }
                ]
            },
            touchicons: {
                files: [
                    {
                        expand: true,
                        cwd: 'html/',
                        src: ['*.png'],
                        dest: 'html/',
                        ext: '.png'
                    }
                ]
            },
        },
        
        // watch
        watch: {
            less: {
                files: ['<%= config.assets.less %>/*.less'],
                tasks: ['less', 'cmq']
            },
            js: {
                files: ['<%= config.assets.js %>/*.js'],
                tasks: ['uglify']
            },
            livereload: {
                options: {
                    livereload: true
                },
                files: [
                    '<%= config.assets.css %>/*.css',
                    '<%= config.assets.js %>/*.js',
                    '<%= config.assets.img %>/*.{png,jpg,jpeg,gif,webp,svg}'
                ]
            }
        },
            
    });
    
    // Load NPM Tasks, smart code stolen from @bluemaex <https://github.com/bluemaex>
    require('fs').readdirSync('node_modules').filter(function (file) {
        return file && file.indexOf('grunt-') > -1;
    }).forEach(function (file) {
        grunt.loadNpmTasks(file);
    });
    
    // Default Task
    grunt.registerTask('default', [
        'watch'
    ]);
    
    // Dev server
    grunt.registerTask('server', [
        'less',
        'cmq',
        'cssmin',
        'uglify',
        'watch'
    ]);
    
    // Production build
    grunt.registerTask('build', [
        'imagemin',
        'less',
        'cmq',
        'cssmin',
        'uglify'
    ]);

};