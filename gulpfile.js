import gulp from 'gulp';
import sass from 'gulp-dart-sass';
import plumber from 'gulp-plumber';
import postcss from 'gulp-postcss';
import csso from 'postcss-csso';
import autoprefixer from 'autoprefixer';
import rename from 'gulp-rename';
import ts from "gulp-typescript";
import uglify from "gulp-uglify";
import del from 'del';

export const compileStyles = () => {
  return gulp.src('src/sass/index.scss')
    .pipe(plumber())
    .pipe(sass().on('error', sass.logError))
    .pipe(postcss([
      autoprefixer(),
      csso()
    ]))
    .pipe(rename('style.min.css'))
    .pipe(gulp.dest('build/css', { sourcemaps: '.' }))
}

export const compileTypescript = () => {
  return gulp.src('src/ts/animation.ts')
  .pipe(ts())
  .pipe(uglify())
  .pipe(rename('bundle.min.js'))
  .pipe(gulp.dest('build/js'));
}

const clean = () => {
  return del('build');
};

const watcher = () => {
  gulp.watch('src/sass/**/*.scss', gulp.series(compileStyles));
  gulp.watch('src/ts/*.ts', gulp.series(compileTypescript, reload));
}

export const build = gulp.series(
  clean,
  gulp.parallel(
    compileStyles,
    compileTypescript,
  ),
);

export default gulp.series(
  clean,
  gulp.parallel(
    compileStyles,
    compileTypescript,
  ),
  gulp.series(
    watcher
  )
)