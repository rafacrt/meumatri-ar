<?php
$title = 'Contagem Regressiva';
$time = null;
$main_site_url = get_site_url(1);
$editIcon = $main_site_url.'/wp-content/themes/meumatri/assets/images/Icon.svg';
?>

<section class="countdown-section <?= $args ?>" draggable="true">
<div class="container">
  <h2 class="section-title"><?= $title ?></h2>
  <div class="countdown">
    <div class="time-section" id="days">
      <div class="time-group">
        <div class="time-segment">
          <div class="segment-display">
            <div class="segment-display__top">0</div>
            <div class="segment-display__bottom">0</div>
            <div class="segment-overlay">
              <div class="segment-overlay__top">0</div>
              <div class="segment-overlay__bottom">0</div>
            </div>
          </div>
        </div>
        <div class="time-segment">
          <div class="segment-display">
            <div class="segment-display__top">0</div>
            <div class="segment-display__bottom">0</div>
            <div class="segment-overlay">
              <div class="segment-overlay__top">0</div>
              <div class="segment-overlay__bottom">0</div>
            </div>
          </div>
        </div>
      </div>
      <p>Dias</p>
    </div>

    <div class="time-section" id="hours">
      <div class="time-group">
        <div class="time-segment">
          <div class="segment-display">
            <div class="segment-display__top"></div>
            <div class="segment-display__bottom"></div>
            <div class="segment-overlay">
              <div class="segment-overlay__top"></div>
              <div class="segment-overlay__bottom"> </div>
            </div>
          </div>
        </div>
        <div class="time-segment">
          <div class="segment-display">
            <div class="segment-display__top"></div>
            <div class="segment-display__bottom"></div>
            <div class="segment-overlay">
              <div class="segment-overlay__top"></div>
              <div class="segment-overlay__bottom"></div>
            </div>
          </div>
        </div>
      </div>
      <p>Horas</p>
    </div>

    <div class="time-section" id="minutes">
      <div class="time-group">
        <div class="time-segment">
          <div class="segment-display">
            <div class="segment-display__top"></div>
            <div class="segment-display__bottom"></div>
            <div class="segment-overlay">
              <div class="segment-overlay__top"></div>
              <div class="segment-overlay__bottom"></div>
            </div>
          </div>
        </div>
        <div class="time-segment">
          <div class="segment-display">
            <div class="segment-display__top"></div>
            <div class="segment-display__bottom"></div>
            <div class="segment-overlay">
              <div class="segment-overlay__top"></div>
              <div class="segment-overlay__bottom"></div>
            </div>
          </div>
        </div>
      </div>
      <p>Minutos</p>
    </div>

    <div class="time-section" id="seconds">
      <div class="time-group">
        <div class="time-segment">
          <div class="segment-display">
            <div class="segment-display__top"></div>
            <div class="segment-display__bottom"></div>
            <div class="segment-overlay">
              <div class="segment-overlay__top"></div>
              <div class="segment-overlay__bottom"></div>
            </div>
          </div>
        </div>
        <div class="time-segment">
          <div class="segment-display">
            <div class="segment-display__top"></div>
            <div class="segment-display__bottom"></div>
            <div class="segment-overlay">
              <div class="segment-overlay__top"></div>
              <div class="segment-overlay__bottom"></div>
            </div>
          </div>
        </div>
      </div>
      <p>Segundos</p>
    </div>
  </div>
  </div>
</section>

<style>
  * {
    box-sizing: border-box;
  }


  .countdown {
    margin: 32px auto;
    width: 100%;
    display: flex;
    gap: 16px;
    font-family: sans-serif;
    justify-content: center;
  }

  .time-section {
    text-align: center;
    font-size: 32px;
  }

  .time-section>p {
    font-size: 16px;
  }

  .time-group {
    display: flex;
    width: 5rem;
    /* width: 19.5vw; */
  }

  .time-segment {
    display: block;
    font-size: 32px;
    font-weight: 900;
    width: 100%;
  }

  .segment-display {
    position: relative;
    height: 100%;
  }

  .segment-display__top,
  .segment-display__bottom {
    overflow: hidden;
    text-align: center;
    width: 100%;
    height: 50%;
    position: relative;
  }

  .segment-display__top {
    line-height: 1.5;
    color: #eee;
    background-color: #111;
  }

  .segment-display__bottom {
    line-height: 0;
    color: #fff;
    background-color: #333;
  }

  .segment-overlay {
    position: absolute;
    top: 0;
    perspective: 400px;
    height: 100%;
    width: 100%;
  }

  .segment-overlay__top,
  .segment-overlay__bottom {
    position: absolute;
    overflow: hidden;
    text-align: center;
    width: 100%;
    height: 50%;
  }

  .segment-overlay__top {
    top: 0;
    line-height: 1.5;
    color: #fff;
    background-color: #111;
    transform-origin: bottom;
  }

  .segment-overlay__bottom {
    bottom: 0;
    line-height: 0;
    color: #eee;
    background-color: #333;
    border-top: 2px solid black;
    transform-origin: top;
  }

  .segment-overlay.flip .segment-overlay__top {
    animation: flip-top 0.8s linear;
  }

  .segment-overlay.flip .segment-overlay__bottom {
    animation: flip-bottom 0.8s linear;
  }

  @keyframes flip-top {
    0% {
      transform: rotateX(0deg);
    }

    50%,
    100% {
      transform: rotateX(-90deg);
    }
  }

  @keyframes flip-bottom {

    0%,
    50% {
      transform: rotateX(90deg);
    }

    100% {
      transform: rotateX(0deg);
    }
  }
</style>


<script>
  const targetDate = new Date();
  targetDate.setHours(targetDate.getHours() + 5);

  function getTimeSegmentElements(segmentElement) {
    const segmentDisplay = segmentElement.querySelector(
      '.segment-display'
    );
    const segmentDisplayTop = segmentDisplay.querySelector(
      '.segment-display__top'
    );
    const segmentDisplayBottom = segmentDisplay.querySelector(
      '.segment-display__bottom'
    );

    const segmentOverlay = segmentDisplay.querySelector(
      '.segment-overlay'
    );
    const segmentOverlayTop = segmentOverlay.querySelector(
      '.segment-overlay__top'
    );
    const segmentOverlayBottom = segmentOverlay.querySelector(
      '.segment-overlay__bottom'
    );

    return {
      segmentDisplayTop,
      segmentDisplayBottom,
      segmentOverlay,
      segmentOverlayTop,
      segmentOverlayBottom,
    };
  }

  function updateSegmentValues(
    displayElement,
    overlayElement,
    value
  ) {
    displayElement.textContent = value;
    overlayElement.textContent = value;
  }

  function updateTimeSegment(segmentElement, timeValue) {
    const segmentElements =
      getTimeSegmentElements(segmentElement);

    if (
      parseInt(
        segmentElements.segmentDisplayTop.textContent,
        10
      ) === timeValue
    ) {
      return;
    }

    segmentElements.segmentOverlay.classList.add('flip');

    updateSegmentValues(
      segmentElements.segmentDisplayTop,
      segmentElements.segmentOverlayBottom,
      timeValue
    );

    function finishAnimation() {
      segmentElements.segmentOverlay.classList.remove('flip');
      updateSegmentValues(
        segmentElements.segmentDisplayBottom,
        segmentElements.segmentOverlayTop,
        timeValue
      );

      this.removeEventListener(
        'animationend',
        finishAnimation
      );
    }

    segmentElements.segmentOverlay.addEventListener(
      'animationend',
      finishAnimation
    );
  }

  function updateTimeSection(sectionID, timeValue) {
    const firstNumber = Math.floor(timeValue / 10) || 0;
    const secondNumber = timeValue % 10 || 0;
    const sectionElement = document.getElementById(sectionID);
    const timeSegments =
      sectionElement.querySelectorAll('.time-segment');

    updateTimeSegment(timeSegments[0], firstNumber);
    updateTimeSegment(timeSegments[1], secondNumber);
  }

  function getTimeRemaining(targetDateTime) {
    const nowTime = Date.now();
    const complete = nowTime >= targetDateTime;

    if (complete) {
      return {
        complete,
        seconds: 0,
        minutes: 0,
        hours: 0,
      };
    }

    const secondsRemaining = Math.floor(
      (targetDateTime - nowTime) / 1000
    );
    const hours = Math.floor(secondsRemaining / 60 / 60);
    const minutes =
      Math.floor(secondsRemaining / 60) - hours * 60;
    const seconds = secondsRemaining % 60;

    return {
      complete,
      seconds,
      minutes,
      hours,
    };
  }

  function updateAllSegments() {
    const timeRemainingBits = getTimeRemaining(
      new Date(targetDate).getTime()
    );

    updateTimeSection('seconds', timeRemainingBits.seconds);
    updateTimeSection('minutes', timeRemainingBits.minutes);
    updateTimeSection('hours', timeRemainingBits.hours);

    return timeRemainingBits.complete;
  }

  const countdownTimer = setInterval(() => {
    const isComplete = updateAllSegments();

    if (isComplete) {
      clearInterval(countdownTimer);
    }
  }, 1000);

  updateAllSegments();
</script>