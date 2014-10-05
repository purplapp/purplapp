"use strict";

var gulp         = require("gulp"),
    csso         = require("gulp-csso"),
    uglify       = require("gulp-uglify"),
    useref       = require("gulp-useref"),
    autoprefixer = require("gulp-autoprefixer"),
    buildDir     = "./public/static",
    srcDir       = "./public/static";

gulp.task("twig", function () {
    var assets = useref.assets();

    return gulp.src("./views/*.twig")
        .pipe(assets)
        .pipe(assets.restore())
        .pipe(useref())
        .pipe(gulp.dest("./out/views/"));
});

gulp.task("css", function () {
    gulp.src("./out/views/css/style.min.css")
        .pipe(autoprefixer({
            browsers: ["last 3 versions", "> 5%"],
            cascade: false
        }))
        .pipe(csso())
        .pipe(gulp.dest("./public/css/"));
});

gulp.task("fonts", function () {
    gulp.src("./bower_components/font-awesome/fonts/*")
        .pipe(gulp.dest("./public/fonts/"));
});

gulp.task("js", function () {
    gulp.src("./out/views/js/*.js")
        .pipe(uglify())
        .pipe(gulp.dest("./public/js/"));
});

gulp.task("watch", function () {
    gulp.watch("./views/*.twig", ["twig"]);
    gulp.watch("./views/js/*.js", ["js"]);
    gulp.watch("./views/css/*.css", ["css"]);
    gulp.watch("./bower_components/font-awesome/fonts/*", ["fonts"]);
});

gulp.task("deploy", ["fonts", "twig", "js", "css"]);

gulp.task("default", ["fonts", "twig", "js", "css", "watch"]);
