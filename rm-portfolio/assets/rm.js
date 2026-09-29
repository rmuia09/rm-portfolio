// RM Portfolio — scroll-reveal animations. No dependencies.
document.addEventListener('DOMContentLoaded', function () {
  var targets = document.querySelectorAll('.rm-reveal');
  if (!targets.length) return;

  if ('IntersectionObserver' in window) {
    var observer = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting) {
          entry.target.classList.add('rm-visible');
          observer.unobserve(entry.target);
        }
      });
    }, { threshold: 0.12 });
    targets.forEach(function (el) { observer.observe(el); });
  } else {
    targets.forEach(function (el) { el.classList.add('rm-visible'); });
  }
});
