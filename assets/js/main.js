/* === FITGYM — Main JavaScript === */

document.addEventListener('DOMContentLoaded', () => {

  /* ── Toggle mostrar/esconder senha ── */
  document.querySelectorAll('.toggle-password').forEach(btn => {
    btn.addEventListener('click', () => {
      const input = btn.closest('.input-group').querySelector('input');
      if (!input) return;
      const isPass = input.type === 'password';
      input.type = isPass ? 'text' : 'password';
      btn.textContent = isPass ? '🙈' : '👁';
    });
  });

  /* ── Máscara CPF ── */
  document.querySelectorAll('[data-mask="cpf"]').forEach(el => {
    el.addEventListener('input', () => {
      let v = el.value.replace(/\D/g, '').slice(0,11);
      v = v.replace(/(\d{3})(\d)/, '$1.$2');
      v = v.replace(/(\d{3})(\d)/, '$1.$2');
      v = v.replace(/(\d{3})(\d{1,2})$/, '$1-$2');
      el.value = v;
    });
  });

  /* ── Máscara Telefone/Celular ── */
  document.querySelectorAll('[data-mask="phone"]').forEach(el => {
    el.addEventListener('input', () => {
      let v = el.value.replace(/\D/g, '').slice(0,11);
      if (v.length <= 10) {
        v = v.replace(/(\d{2})(\d)/, '($1) $2');
        v = v.replace(/(\d{4})(\d)/, '$1-$2');
      } else {
        v = v.replace(/(\d{2})(\d)/, '($1) $2');
        v = v.replace(/(\d{5})(\d)/, '$1-$2');
      }
      el.value = v;
    });
  });

  /* ── Máscara CEP ── */
  document.querySelectorAll('[data-mask="cep"]').forEach(el => {
    el.addEventListener('input', () => {
      let v = el.value.replace(/\D/g, '').slice(0,8);
      v = v.replace(/(\d{5})(\d)/, '$1-$2');
      el.value = v;
    });
  });

  /* ── Preview foto ── */
  const photoInput = document.getElementById('foto-input');
  const photoArea  = document.getElementById('photo-area');
  if (photoInput && photoArea) {
    photoInput.addEventListener('change', () => {
      const file = photoInput.files[0];
      if (!file) return;
      const reader = new FileReader();
      reader.onload = e => {
        photoArea.innerHTML = `<img src="${e.target.result}" alt="Foto" style="width:100%;height:100%;object-fit:cover;border-radius:50%;">`;
      };
      reader.readAsDataURL(file);
    });
  }

  /* ── Busca na tabela ── */
  const searchInput = document.getElementById('table-search');
  if (searchInput) {
    searchInput.addEventListener('input', () => {
      const q = searchInput.value.toLowerCase();
      document.querySelectorAll('tbody tr').forEach(row => {
        row.style.display = row.textContent.toLowerCase().includes(q) ? '' : 'none';
      });
    });
  }

  /* ── Dashboard Chart ── */
  const canvas = document.getElementById('dashboard-chart');
  if (canvas) drawDashboardChart(canvas);

});

/* ── Draw Line Chart ── */
function drawDashboardChart(canvas) {
  const ctx = canvas.getContext('2d');
  const dpr = window.devicePixelRatio || 1;
  const parent = canvas.parentElement;
  const W = parent.clientWidth;
  const H = parent.clientHeight || 210;

  canvas.width  = W * dpr;
  canvas.height = H * dpr;
  canvas.style.width  = W + 'px';
  canvas.style.height = H + 'px';
  ctx.scale(dpr, dpr);

  const labels = ['Jan','Fev','Mar','Abr','Mai','Jun','Jul'];
  const data   = [80, 110, 95, 155, 180, 215, 248];
  const green  = '#a3f42c';
  const greenA = 'rgba(163,244,44,';

  const padL = 36, padR = 16, padT = 16, padB = 32;
  const chartW = W - padL - padR;
  const chartH = H - padT - padB;

  const minV = 0;
  const maxV = 300;

  const xPos = i => padL + (i / (data.length - 1)) * chartW;
  const yPos = v => padT + (1 - (v - minV) / (maxV - minV)) * chartH;

  /* Grid lines */
  ctx.strokeStyle = 'rgba(255,255,255,0.06)';
  ctx.lineWidth = 1;
  [0, 50, 100, 150, 200, 250, 300].forEach(v => {
    const y = yPos(v);
    ctx.beginPath();
    ctx.moveTo(padL, y);
    ctx.lineTo(W - padR, y);
    ctx.stroke();
    ctx.fillStyle = 'rgba(255,255,255,0.3)';
    ctx.font = '10px Inter, sans-serif';
    ctx.textAlign = 'right';
    ctx.fillText(v, padL - 6, y + 3);
  });

  /* Gradient fill */
  const grad = ctx.createLinearGradient(0, padT, 0, padT + chartH);
  grad.addColorStop(0,   greenA + '0.28)');
  grad.addColorStop(0.6, greenA + '0.06)');
  grad.addColorStop(1,   greenA + '0)');

  ctx.beginPath();
  ctx.moveTo(xPos(0), yPos(data[0]));
  for (let i = 1; i < data.length; i++) {
    const cx = (xPos(i-1) + xPos(i)) / 2;
    ctx.bezierCurveTo(cx, yPos(data[i-1]), cx, yPos(data[i]), xPos(i), yPos(data[i]));
  }
  ctx.lineTo(xPos(data.length - 1), padT + chartH);
  ctx.lineTo(padL, padT + chartH);
  ctx.closePath();
  ctx.fillStyle = grad;
  ctx.fill();

  /* Line */
  ctx.beginPath();
  ctx.moveTo(xPos(0), yPos(data[0]));
  for (let i = 1; i < data.length; i++) {
    const cx = (xPos(i-1) + xPos(i)) / 2;
    ctx.bezierCurveTo(cx, yPos(data[i-1]), cx, yPos(data[i]), xPos(i), yPos(data[i]));
  }
  ctx.strokeStyle = green;
  ctx.lineWidth = 2.5;
  ctx.shadowColor = green;
  ctx.shadowBlur = 8;
  ctx.stroke();
  ctx.shadowBlur = 0;

  /* Dots */
  data.forEach((v, i) => {
    ctx.beginPath();
    ctx.arc(xPos(i), yPos(v), 4, 0, Math.PI * 2);
    ctx.fillStyle = green;
    ctx.fill();
    ctx.strokeStyle = '#080a0d';
    ctx.lineWidth = 2;
    ctx.stroke();
  });

  /* Labels X */
  ctx.fillStyle = 'rgba(255,255,255,0.38)';
  ctx.font = '11px Inter, sans-serif';
  ctx.textAlign = 'center';
  labels.forEach((l, i) => {
    ctx.fillText(l, xPos(i), H - 6);
  });
}
