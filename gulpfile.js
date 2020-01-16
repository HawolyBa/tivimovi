const gulp = require('gulp')
const sass = require('gulp-sass')
const browserSync = require('browser-sync').create()
const autoprefixer = require('gulp-autoprefixer');

function style() {
  return gulp.src('./scss/style.scss')
            .pipe(sass())
            .pipe(autoprefixer("last 2 versions"))
            .pipe(gulp.dest('./'))
            .pipe(browserSync.stream())
}

function watch() {
  browserSync.init({
    proxy: 'localhost/tivimovi',
  })
  gulp.watch('./scss/**/*.scss', style)
  gulp.watch('./*.php').on('change', browserSync.reload)
  gulp.watch('./js/**/.js').on('change', browserSync.reload)

}

exports.style = style
exports.watch = watch