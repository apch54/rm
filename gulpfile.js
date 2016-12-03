var gulp = require('gulp');
var coffee = require('gulp-coffee');
var concat = require('gulp-concat');

gulp.task('default', ['watch']);

gulp.task('coffee', function(){
  return gulp.src("assets/libs/phacker/src/**/*.coffee")
      .pipe(coffee())
      .pipe(concat('phacker.js'))
      .pipe(gulp.dest('assets/libs/phacker/build/'));
});

gulp.task('watch', function() {
  gulp.watch('assets/libs/phacker/src/**/*.coffee', ['coffee']);
});
