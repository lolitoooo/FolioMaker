
<h1 style="font-family: 'Roboto';">Nos composants</h1>
<div style="display: flex; flex-direction: column; gap: 2rem;">
   <div style="display: flex; flex-direction:column; gap: 1rem;">
    <h2>Buttons</h2>
    <h4>Normal</h4>
        <div style="display: flex; gap: 1rem">
            <button class="button button-primary">Button</button>
            <button class="button button-secondary">Button</button>
            <button class="button button-borderless">Button</button>
            <button class="button button-icon">
                <img style="width: 1rem; height: 1rem; background: none; filter: invert(100%);" src="../../src/assets/icons/left-arrow.svg" alt="">
                Button
            </button>
            <button class="button button-icon">
                Button
                <img style="width: 1rem; height: 1rem; background: none; filter: invert(100%);" src="../../src/assets/icons/right-arrow.svg" alt="">
            </button>
            <button class="button button-secondary button-icon">
                <img style="width: 1rem; height: 1rem; background: none;" src="../../src/assets/icons/left-arrow.svg" alt="">
                Button
            </button>
            <button class="button button-secondary button-icon">
                Button
                <img style="width: 1rem; height: 1rem; background: none;" src="../../src/assets/icons/right-arrow.svg" alt="">
            </button>
        </div>
    <h4>Small</h4>
        <div style="display: flex; gap: 1rem">
            <button class="button button-primary button-small">Button</button>
            <button class="button button-secondary button-small">Button</button>
            <button class="button button-borderless button-small">Button</button>
            <button class="button button-icon button-small">
                <img style="width: 1rem; height: 1rem; background: none; filter: invert(100%);" src="../../src/assets/icons/left-arrow.svg" alt="">
                Button
            </button>
            <button class="button button-icon button-small">
                Button
                <img style="width: 1rem; height: 1rem; background: none; filter: invert(100%);" src="../../src/assets/icons/right-arrow.svg" alt="">
            </button>
            <button class="button button-secondary button-icon button-small">
                <img style="width: 1rem; height: 1rem; background: none;" src="../../src/assets/icons/left-arrow.svg" alt="">
                Button
            </button>
            <button class="button button-secondary button-icon button-small">
                Button
                <img style="width: 1rem; height: 1rem; background: none;" src="../../src/assets/icons/right-arrow.svg" alt="">
            </button>
        </div>
   </div>

    <div>
        <h2>Shadows</h2>
        <div style="display: flex; gap: 1rem">
            <div style="width: 8rem; height: 8rem;" class="shadow-xxsmall">
                <p>xxsmall</p>
            </div>
            <div style="width: 8rem; height: 8rem;" class="shadow-xsmall">
                <p>xsmall</p>
            </div>
            <div style="width: 8rem; height: 8rem;" class="shadow-small">
                <p>small</p>
            </div>
            <div style="width: 8rem; height: 8rem;" class="shadow-medium">
                <p>medium</p>
            </div>
            <div style="width: 8rem; height: 8rem;" class="shadow-large">
                <p>large</p>
            </div>
            <div style="width: 8rem; height: 8rem;" class="shadow-xlarge">
                <p>xlarge</p>
            </div>
            <div style="width: 8rem; height: 8rem;" class="shadow-xxlarge">
                <p>xxlarge</p>
            </div>
        </div>
    </div>

    <div>
        <h2>Inputs</h2>
        <div style="display: flex; flex-direction: column; gap: 1rem">
            <input type="text" class="input">
            <textarea class="input" name="" id="" cols="30" rows="10"></textarea>
            <div class="input-action-square">
                <input type="radio" id="radio1" name="radio">
                <label for="radio1"></label>
            </div>
            <input class="input-action" type="radio" name="" id="">
        </div>
    </div>

    <div>
        <h2>Tooltips</h2>
        <div style="display: flex; flex-direction: column; gap: 1rem">
            <div class="tooltip">
                <p>Hello World it's tooltip</p>
                <img src="www/src/assets/icons/arrow-bottom.svg" alt="">
            </div>
        </div>
    </div>
</div>