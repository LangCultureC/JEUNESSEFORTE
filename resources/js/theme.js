const root = document.documentElement;
const systemTheme = matchMedia('(prefers-color-scheme: dark)');
let preference;
try { preference = localStorage.getItem('jeunesseforte-theme'); } catch {}
if (!['light', 'dark'].includes(preference)) preference = null;

function applyTheme(theme) {
    root.dataset.theme = theme;
    document.querySelectorAll('.theme-toggle').forEach(button => {
        button.setAttribute('aria-pressed', String(theme === 'dark'));
        button.title = theme === 'dark' ? 'Passer en mode clair' : 'Passer en mode sombre';
    });
}
applyTheme(preference || (systemTheme.matches ? 'dark' : 'light'));
document.querySelectorAll('.theme-toggle').forEach(button => {
    button.addEventListener('click', () => {
        preference = root.dataset.theme === 'dark' ? 'light' : 'dark';
        applyTheme(preference);
        try { localStorage.setItem('jeunesseforte-theme', preference); } catch {}
    });
});
systemTheme.addEventListener('change', event => {
    if (!preference) applyTheme(event.matches ? 'dark' : 'light');
});
window.addEventListener('storage', event => {
    if (event.key !== 'jeunesseforte-theme' && event.key !== null) return;
    preference = ['light', 'dark'].includes(event.newValue) ? event.newValue : null;
    applyTheme(preference || (systemTheme.matches ? 'dark' : 'light'));
});
