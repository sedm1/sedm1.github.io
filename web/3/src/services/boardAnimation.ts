import { Action } from "../types";

export const animateBoard = (root: Element, prevFields: number[][], fields: number[][], action: Action) => {
    const board = root.querySelector('.board');
    if (!board) return;
  
    let layer = board.querySelector('.tiles-layer');
    if (!layer) {
      layer = document.createElement('div');
      layer.className = 'tiles-layer';
      board.appendChild(layer);
    }
    layer.innerHTML = '';
  
    const innerW = board.clientWidth;
    const innerH = board.clientHeight;
    const cellW = innerW / 4;
    const cellH = innerH / 4;
    const inset = 6;
    const tileW = Math.max(0, cellW - inset * 2);
    const tileH = Math.max(0, cellH - inset * 2);
  
    const prevMap: Record<string, any> = {};
    if (prevFields) {
      for (let r = 0; r < 4; r++) {
        for (let c = 0; c < 4; c++) {
          const v = prevFields[r][c];
          if (!v) continue;
          const k = String(v);
          prevMap[k] = prevMap[k] || [];
          prevMap[k].push({ r, c });
        }
      }
    }
  
    for (let r = 0; r < 4; r++) {
      for (let c = 0; c < 4; c++) {
        const value = fields[r][c];
        if (!value) continue;
  
        const tile = document.createElement('div');
        tile.className = `tile board-item board-item-${value}`;
        tile.textContent = String(value);
        if (String(value).length >= 4) tile.classList.add('small');
  
        tile.style.position = 'absolute';
        tile.style.width = `${tileW}px`;
        tile.style.height = `${tileH}px`;
        tile.style.lineHeight = `${tileH}px`;
        tile.style.boxSizing = 'border-box';
        tile.style.zIndex = '10';
  
        const targetLeft = Math.round(c * cellW + inset);
        const targetTop = Math.round(r * cellH + inset);
  
        let didAnimate = false;
  
        if (prevFields && prevFields[r][c] === value) {
          const list = prevMap[String(value)];
          if (list && list.length) {
            for (let i = 0; i < list.length; i++) {
              if (list[i].r === r && list[i].c === c) {
                list.splice(i, 1);
                break;
              }
            }
          }
          tile.style.left = `${targetLeft}px`;
          tile.style.top = `${targetTop}px`;
          layer.appendChild(tile);
          continue;
        }
  
        const list = prevMap[String(value)];
        if (list && list.length) {
          const start = list.shift(); // FIFO
          const startLeft = Math.round(start.c * cellW + inset);
          const startTop = Math.round(start.r * cellH + inset);
          tile.style.left = `${startLeft}px`;
          tile.style.top = `${startTop}px`;
          layer.appendChild(tile);
          requestAnimationFrame(() => {
            tile.style.left = `${targetLeft}px`;
            tile.style.top = `${targetTop}px`;
          });
          didAnimate = true;
        } else {
          tile.style.left = `${targetLeft}px`;
          tile.style.top = `${targetTop}px`;
          layer.appendChild(tile);
        }
      }
    }
  };