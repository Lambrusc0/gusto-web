// //////////////////////////////////////////////////////////
// Required
// //////////////////////////////////////////////////////////
var gulp = require('gulp'),
    uglify = require('gulp-uglify'),
    browserSync = require('browser-sync'),
    reload = browserSync.reload,
    compass = require('gulp-compass'),
    plumber = require('gulp-plumber'),
    autoprefixer = require('gulp-autoprefixer'),
    rename = require('gulp-rename');


// //////////////////////////////////////////////////////////
// Scripts Task
// //////////////////////////////////////////////////////////
gulp.task('scripts', function(){
    gulp.src(['public/js/**/*.js', '!public/js/**/*.min.js'])
        .pipe(plumber())
        .pipe(rename({suffix: '.min'}))
        .pipe(uglify())
        .pipe(gulp.dest('public/js'))
        .pipe(reload({stream:true}));
});


// //////////////////////////////////////////////////////////
// Compass / Sass Task
// //////////////////////////////////////////////////////////
gulp.task('compass', function(){
    gulp.src('public/scss/style.scss')
        .pipe(plumber())
        .pipe(compass({
            config_file: './config.rb',
            css: 'public/css',
            sass: 'public/scss',
            require: ['susy']
        }))
        .pipe(autoprefixer('last 2 versions'))
        .pipe(gulp.dest('public/css/'))
        .pipe(reload({stream:true}))
    })


// //////////////////////////////////////////////////////////
// HTML Task
// //////////////////////////////////////////////////////////
gulp.task('html', function(){
    gulp.src('public/**/*.html')
    .pipe(reload({stream:true}));
})


// //////////////////////////////////////////////////////////
// Browser-Sync Task
// //////////////////////////////////////////////////////////
gulp.task('browser-sync', function(){
    browserSync({
        server:{
            baseDir: "./public/"
        }
    })
})


// //////////////////////////////////////////////////////////
// Watch Task
// //////////////////////////////////////////////////////////
gulp.task('watch', function(){
    gulp.watch('public/js/**/*.js', ['scripts']);
    gulp.watch('public/scss/**/*.scss', ['compass']);
    gulp.watch('public/**/*.html', ['html']);
})


// //////////////////////////////////////////////////////////
// Default Task
// //////////////////////////////////////////////////////////

gulp.task('default', ['scripts', 'compass', 'html', 'browser-sync', 'watch']);