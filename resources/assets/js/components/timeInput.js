class TimeInput extends HTMLElement {
    constructor() {
        super();
        this.attachShadow({ mode: 'open' });
    }

    connectedCallback() {
        this.render();
        this.setupIncrementDecrement();
        this.setInitialValues();
    }

    render() {
        this.shadowRoot.innerHTML = `
    <!-- FONTAWESOME -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- FONTAWESOME -->
     <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>
            <style>
                *{
                    box-sizing: border-box;
                    margin: 0;
                    padding: 0;
                }
                .el-group-input-number{
                    height: 30px;
                    position: relative;
                    display: flex;
                    align-items: center;
                    gap: .15rem;
                }.el-group-input-number .el-number{
                    display: block;
                    height: 100%;
                    border: none;
                    outline: none;
                    width: 30px;
                    font-family: var(--font-family);
                    text-align: center;
                    font-size: 1rem;
                    background-color: transparent;
                    color: #666;
                }.el-group-input-number .el-controls{
                    display: flex;
                    flex-direction: column;
                    gap: 1px;
                }.el-group-input-number .svg-inline--fa,
                .el-group-input-number .fas{
                    font-size: .7rem;
                    transition: .3s;
                    cursor: pointer;
                    color: #666;
                }.el-group-input-number .svg-inline--fa:hover,
                .el-group-input-number .fas:hover{
                    color: #000;
                    transform: scale(1.5);
                }.el-container-time{
                    display: flex;
                    align-items: center;
                    gap: .5rem;
                    padding-top: .12rem;
                }.el-group-input-number button{
                    outline: none;
                    border: none;
                    background: none;
                }#el-time-input{
                    display: flex;
                    flex-direction: column;
                    align-items: center;
                    gap: 1rem;
                    width: fit-content;
                    border: 1px solid rgba(0, 0, 0, .15);
                    padding: .5rem 1rem;
                    border-radius: 10px;
                    box-shadow: inset 0 0 20px rgba(0, 0, 0, .15)
                }#el-time-input h3{
                    font-size: .9rem
                }
            </style>
            <div id="el-time-input">
                <div class="el-container-start">
                    <h3>Début</h3>
                    <div id="el-start" class="el-container-time">
                        <div class="el-group-input-number">
                            <input type="text" name="start_hour" min="0" max="23" placeholder="HH" class="el-number" />
                            <div class="el-controls">
                                <button class="el-up">
                                    <i class="fas fa-chevron-up"></i>
                                </button>
                                
                                <button class="el-down">
                                    <i class="fas fa-chevron-down"></i>
                                </button>
                            </div>
                        </div>
                        <div class="el-group-input-number">
                            <input type="text" name="start_minute" min="0" max="59" placeholder="MM" class="el-number" />
                            <div class="el-controls">
                                <button class="el-up">
                                    <i class="fas fa-chevron-up"></i>
                                </button>
                                <button class="el-down">
                                    <i class="fas fa-chevron-down"></i>
                                </button>
                            </div>
                        </div>
                        <div class="el-group-input-number">
                            <input type="text" name="start_second" min="0" max="59" placeholder="SS" class="el-number" />
                            <div class="el-controls">
                                <button class="el-up">
                                    <i class="fas fa-chevron-up"></i>
                                </button>
                                <button class="el-down">
                                    <i class="fas fa-chevron-down"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="el-container-end">
                    <h3>Fin</h3>
                    <div id="el-end" class="el-container-time">
                        <div class="el-group-input-number">
                            <input type="text" name="end_hour" min="0" max="23" placeholder="HH" class="el-number" />
                            <div class="el-controls">
                                <button class="el-up">
                                    <i class="fas fa-chevron-up"></i>
                                </button>
                                <button class="el-down">
                                    <i class="fas fa-chevron-down"></i>
                                </button>
                            </div>
                        </div>
                        <div class="el-group-input-number">
                            <input type="text" name="end_minute" min="0" max="59" placeholder="MM" class="el-number" />
                            <div class="el-controls">
                                <button class="el-up">
                                    <i class="fas fa-chevron-up"></i>
                                </button>
                                <button class="el-down">
                                    <i class="fas fa-chevron-down"></i>
                                </button>
                            </div>
                        </div>
                        <div class="el-group-input-number">
                            <input type="text" name="end_second" min="0" max="59" placeholder="SS" class="el-number" />
                            <div class="el-controls">
                                <button class="el-up">
                                    <i class="fas fa-chevron-up"></i>
                                </button>
                                <button class="el-down">
                                    <i class="fas fa-chevron-down"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `;
    }

    setInitialValues() {
        // Si des valeurs sont passées dans les attributs, les utiliser
        const startHour = this.getAttribute('start-hour') || '00';
        const startMinute = this.getAttribute('start-minute') || '00';
        const startSecond = this.getAttribute('start-second') || '00';
        
        const endHour = this.getAttribute('end-hour') || '00';
        const endMinute = this.getAttribute('end-minute') || '00';
        const endSecond = this.getAttribute('end-second') || '00';
        
        this.shadowRoot.querySelector('input[name="start_hour"]').value = startHour;
        this.shadowRoot.querySelector('input[name="start_minute"]').value = startMinute;
        this.shadowRoot.querySelector('input[name="start_second"]').value = startSecond;
        
        this.shadowRoot.querySelector('input[name="end_hour"]').value = endHour;
        this.shadowRoot.querySelector('input[name="end_minute"]').value = endMinute;
        this.shadowRoot.querySelector('input[name="end_second"]').value = endSecond;
    }

    setupIncrementDecrement() {
        const containerStart = this.shadowRoot.querySelector('#el-start');
        const containerEnd = this.shadowRoot.querySelector('#el-end');
        this.setupForContainer(containerStart);
        this.setupForContainer(containerEnd);
    }

    setupForContainer(container) {
        const inputs = container.querySelectorAll('.el-number');
        inputs.forEach(input => {
            const controls = input.parentElement.querySelector('.el-controls');
            const incrementBtn = controls.querySelector('.el-up');
            const decrementBtn = controls.querySelector('.el-down');

            incrementBtn.addEventListener('click', () => this.updateValue(input, 1));
            decrementBtn.addEventListener('click', () => this.updateValue(input, -1));

            input.addEventListener('blur', () => this.validateInput(input));
            input.addEventListener('input', () => this.validateInput(input));
        });
    }

    updateValue(input, step) {
        let value = parseInt(input.value) || 0;
        const name = input.getAttribute('name');
    
        if (name.includes('hour')) {
            value = (value + step + 24) % 24;
        } else if (name.includes('minute') || name.includes('second')) {
            value += step;
    
            if (value > 59) {
                value = 0;
                this.incrementParent(input, name);
            } else if (value < 0) {
                value = 59;
                this.decrementParent(input, name);
            }
        }
    
        input.value = value.toString().padStart(2, '0');
    
        // Vérification après chaque modification
        if (name.includes('end')) {
            this.checkTimeOrder();
        }
    }
    
    

    validateInput(input) {
        let value = parseInt(input.value) || 0;
        const name = input.getAttribute('name');

        if (name.includes('hour')) {
            value = Math.min(Math.max(value, 0), 23);
        } else if (name.includes('minute') || name.includes('second')) {
            value = Math.min(Math.max(value, 0), 59);
        }

        input.value = value.toString().padStart(2, '0');
        this.checkTimeOrder();
    }

    checkTimeOrder() {
        const startHour = parseInt(this.shadowRoot.querySelector('input[name="start_hour"]').value) || 0;
        const startMinute = parseInt(this.shadowRoot.querySelector('input[name="start_minute"]').value) || 0;
        const startSecond = parseInt(this.shadowRoot.querySelector('input[name="start_second"]').value) || 0;
    
        const endHour = parseInt(this.shadowRoot.querySelector('input[name="end_hour"]').value) || 0;
        const endMinute = parseInt(this.shadowRoot.querySelector('input[name="end_minute"]').value) || 0;
        const endSecond = parseInt(this.shadowRoot.querySelector('input[name="end_second"]').value) || 0;
    
        // Vérifier si la plage de fin est inférieure à la plage de début
        if (
            endHour < startHour ||
            (endHour === startHour && endMinute < startMinute) ||
            (endHour === startHour && endMinute === startMinute && endSecond < startSecond)
        ) {
            this.shadowRoot.querySelector('input[name="end_hour"]').value = startHour.toString().padStart(2, '0');
            this.shadowRoot.querySelector('input[name="end_minute"]').value = startMinute.toString().padStart(2, '0');
            this.shadowRoot.querySelector('input[name="end_second"]').value = startSecond.toString().padStart(2, '0');
        }
    }
    

    incrementParent(input, name) {
        if (name.includes('second')) {
            const minuteInput = input.name.includes('start')
                ? this.shadowRoot.querySelector('input[name="start_minute"]')
                : this.shadowRoot.querySelector('input[name="end_minute"]');
            this.updateValue(minuteInput, 1);
        } else if (name.includes('minute')) {
            const hourInput = input.name.includes('start')
                ? this.shadowRoot.querySelector('input[name="start_hour"]')
                : this.shadowRoot.querySelector('input[name="end_hour"]');
            this.updateValue(hourInput, 1);
        }
    }
    
    decrementParent(input, name) {
        if (name.includes('second')) {
            const minuteInput = input.name.includes('start')
                ? this.shadowRoot.querySelector('input[name="start_minute"]')
                : this.shadowRoot.querySelector('input[name="end_minute"]');
            this.updateValue(minuteInput, -1);
        } else if (name.includes('minute')) {
            const hourInput = input.name.includes('start')
                ? this.shadowRoot.querySelector('input[name="start_hour"]')
                : this.shadowRoot.querySelector('input[name="end_hour"]');
            this.updateValue(hourInput, -1);
        }
    }
    
    

    getCounterpartName(name) {
        if (name.includes('start')) {
            return name.replace('start', 'end');
        }
        return name.replace('end', 'start');
    }
}

customElements.define('time-input', TimeInput);
