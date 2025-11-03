export const initController = (root, emit) => {
    if ('ontouchstart' in window || navigator.maxTouchPoints > 0) {
        initOnMobile(root, emit);
    }
    else {
        initOnDesktop(root, emit);
    }
};
const initOnMobile = (element, emit) => {
    let startX = 0, startY = 0, endX = 0, endY = 0;
    element.addEventListener('touchstart', (e) => {
        startX = e.touches[0].clientX;
        startY = e.touches[0].clientY;
    });
    element.addEventListener('touchend', (e) => {
        endX = e.changedTouches[0].clientX;
        endY = e.changedTouches[0].clientY;
        const diffX = endX - startX;
        const diffY = endY - startY;
        if (Math.abs(diffX) > Math.abs(diffY)) {
            emit(diffX > 0 ? 'right' : 'left');
        }
        else {
            emit(diffY > 0 ? 'down' : 'up');
        }
    });
};
const initOnDesktop = (_element, emit) => {
    window.addEventListener('keydown', (e) => {
        switch (e.key) {
            case 'ArrowUp':
                emit('up');
                break;
            case 'ArrowDown':
                emit('down');
                break;
            case 'ArrowLeft':
                emit('left');
                break;
            case 'ArrowRight':
                emit('right');
                break;
        }
    });
};
//# sourceMappingURL=controller.js.map