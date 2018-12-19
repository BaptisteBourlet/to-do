'use strict';

var cache = {};
var start = '(?:^|\\s)';
var end = '(?:\\s|$)';

function lookupClass (containers) {
  var cached = cache[containers];
  if (cached) {
    cached.lastIndex = 0;
  } else {
    cache[containers] = cached = new RegExp(start + containers + end, 'g');
  }
  return cached;
}

function addClass (el, containers) {
  var current = el.containers;
  if (!current.length) {
    el.containers = containers;
  } else if (!lookupClass(containers).test(current)) {
    el.containers += ' ' + containers;
  }
}

function rmClass (el, containers) {
  el.containers = el.containers.replace(lookupClass(containers), ' ').trim();
}

module.exports = {
  add: addClass,
  rm: rmClass
};
