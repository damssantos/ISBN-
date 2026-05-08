const fs = require('fs');
const path = require('path');

const dir = path.join(__dirname, 'resources/views');
const files = fs.readdirSync(dir).filter(f => f.endsWith('.blade.php'));

/**
 * FINAL PALETTE — "ISBN Color Palette" from Coolors:
 *   #0C3748  — deep teal (primary accent-dark bg tones)
 *   #475D68  — blue-grey (muted/borders/secondary surfaces)
 *   #1B2B38  — very dark navy (card / surface)
 *   #3BC3BD  — vibrant cyan (primary interactive)
 *   #2B3D49  — dark teal-navy (elevated surface)
 *
 * Hierarchy to achieve visual clarity:
 *   bg-body     = #0f1d26  (deepest — body background)
 *   bg-sidebar  = #0f1d26  (same depth as body — sidebar blends)
 *   bg-card     = #1B2B38  (cards float above body — clear separation)
 *   bg-elevated = #2B3D49  (dropdowns / tooltip / elevated panels)
 *   bg-card-hover= #2e4255 (hover state, slightly brighter)
 *   bg-input    = #111f2a  (inputs are DARKER than cards — very clear)
 *
 *   border-color = #2e4459  (visible but subtle border)
 *   border-light = #1e3040  (very subtle inner border)
 *
 *   primary        = #3BC3BD  (cyan from palette)
 *   primary-bright = #5CD9D4  (lighter cyan — hover)
 *   primary-dim    = #2E9B96  (darker cyan — pressed/dim)
 *   primary-glow   = rgba(59, 195, 189, 0.15)
 *
 *   text-primary   = #F0F6FA  (crisp near-white)
 *   text-secondary = #B8CDD8  (clear readable mid-tone)
 *   text-muted     = #7A9BAA  (muted — visible but subdued)
 *
 *   Status:
 *   Delivered/Review  → Blue   #3B82F6
 *   Completed/Done    → Cyan   #3BC3BD
 *   Prepared/Pending  → Orange #F97316
 *   Draft             → Grey   #64748B
 */

const VAR = {
    '--primary':                '#3BC3BD',
    '--primary-bright':         '#5CD9D4',
    '--primary-dim':            '#2E9B96',
    '--primary-glow':           'rgba(59, 195, 189, 0.15)',
    '--accent':                 '#3BC3BD',
    '--bg-body':                '#0f1d26',
    '--bg-sidebar':             '#0c1a22',
    '--bg-card':                '#1B2B38',
    '--bg-card-hover':          '#2e4255',
    '--bg-input':               '#111f2a',
    '--bg-elevated':            '#2B3D49',
    '--border-color':           '#2e4459',
    '--border-light':           '#1e3040',
    '--text-primary':           '#F0F6FA',
    '--text-secondary':         '#B8CDD8',
    '--text-muted':             '#7A9BAA',
    '--status-review-bg':       'rgba(59, 130, 246, 0.12)',
    '--status-review-text':     '#60A5FA',
    '--status-published-bg':    'rgba(59, 195, 189, 0.15)',
    '--status-published-text':  '#3BC3BD',
    '--status-draft-bg':        'rgba(249, 115, 22, 0.12)',
    '--status-draft-text':      '#FB923C',
};

// Every hex shade that should map to a new one (case-insensitive)
const HEX_MAP = {
    // Old purples / old teals → body
    '#15131e': '#0f1d26',
    '#0c3748': '#0f1d26',
    // Sidebar
    '#1e1b2e': '#0c1a22',
    '#10212b': '#0c1a22',
    // Card
    '#231f36': '#1B2B38',
    '#142733': '#1B2B38',
    '#1b2b38': '#1B2B38',
    // Elevated / card-hover
    '#2d2845': '#2B3D49',
    '#253745': '#2B3D49',
    '#2b3d49': '#2B3D49',
    '#253b47': '#2e4255',
    '#1c3444': '#2e4255',
    '#475d68': '#475D68',   // keep — used in palette swatch
    // Inputs (deepest)
    '#1b1829': '#111f2a',
    '#0a161d': '#111f2a',
    '#0d141a': '#111f2a',
    // Borders
    '#342e4a': '#2e4459',
    '#26404c': '#2e4459',
    '#2d414a': '#2e4459',
    // Primary (old purples → cyan)
    '#8b5cf6': '#3BC3BD',
    '#a78bfa': '#5CD9D4',
    '#6d28d9': '#2E9B96',
    // Old greens/teals
    '#20c997': '#3BC3BD',
    '#34d399': '#5CD9D4',
    '#059669': '#2E9B96',
    '#7ba19d': '#3BC3BD',
    '#9dc2c0': '#5CD9D4',
    '#5a7a78': '#2E9B96',
    '#2e9b96': '#2E9B96',
    '#3bc3bd': '#3BC3BD',   // identity (no-op)
    '#5cd9d4': '#5CD9D4',   // identity (no-op)
};

// RGBA replacements: source rgba → new rgba (exact pattern)
const RGBA_MAP = [
    // Old primary rgbas
    { from: /rgba\(139,\s*92,\s*246/g,   to: 'rgba(59, 195, 189' },
    { from: /rgba\(32,\s*201,\s*151/g,   to: 'rgba(59, 195, 189' },
    { from: /rgba\(123,\s*161,\s*157/g,  to: 'rgba(59, 195, 189' },
    // Old bg semi-transparent
    { from: /rgba\(30,\s*27,\s*46,\s*0\.6\)/g,  to: 'rgba(15, 29, 38, 0.7)' },
    { from: /rgba\(16,\s*33,\s*43,\s*0\.6\)/g,  to: 'rgba(15, 29, 38, 0.7)' },
    { from: /rgba\(12,\s*55,\s*72,\s*0\.6\)/g,  to: 'rgba(15, 29, 38, 0.7)' },
    { from: /rgba\(13,\s*20,\s*26,\s*0\.6\)/g,  to: 'rgba(15, 29, 38, 0.7)' },
];

// Welcome banner gradient (always replace any dark-to-dark gradient in the banner)
const GRADIENT_OVERRIDES = [
    {
        from: /linear-gradient\(135deg,\s*#[a-f0-9]{6}\s*0%,\s*#[a-f0-9]{6}\s*100%\)/gi,
        to:   'linear-gradient(135deg, #1B2B38 0%, #0c1a22 100%)'
    },
    // nav-link active gradient
    {
        from: /linear-gradient\(90deg,\s*rgba\([\d,\s.]+\)\s*,\s*rgba\([\d,\s.]+\)\)/g,
        to:   'linear-gradient(90deg, rgba(59, 195, 189, 0.16), rgba(59, 195, 189, 0.06))'
    },
];

// Stat/activity icon classes:  keep emerald/orange/gray icon colours as-is for status variety

function escapeRegex(str) {
    return str.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
}

for (const file of files) {
    const filePath = path.join(dir, file);
    let content = fs.readFileSync(filePath, 'utf8');

    // 1. Replace :root CSS variables (very greedy — match any value after the colon)
    for (const [name, value] of Object.entries(VAR)) {
        // Handles both shorthands like "--primary: #xxx;" and full declarations
        const re = new RegExp(`(${escapeRegex(name)}:\\s*)[^;]+;`, 'gi');
        content = content.replace(re, `$1${value};`);
    }

    // 2. Hex colour swaps (case-insensitive, whole-word)
    for (const [old, neu] of Object.entries(HEX_MAP)) {
        if (old === neu.toLowerCase()) continue; // skip identity
        const re = new RegExp(escapeRegex(old), 'gi');
        content = content.replace(re, neu);
    }

    // 3. RGBA swaps
    for (const { from, to } of RGBA_MAP) {
        content = content.replace(from, to);
    }

    // 4. Gradient overrides
    for (const { from, to } of GRADIENT_OVERRIDES) {
        content = content.replace(from, to);
    }

    // 5. Ensure inputs specifically use the deep bg-input colour
    //    The form-control rule: background:var(--bg-body) → background:var(--bg-input)
    content = content.replace(
        /.form-control\s*\{[^}]+background:\s*var\(--bg-body\)/g,
        (m) => m.replace('var(--bg-body)', 'var(--bg-input)')
    );

    // 6. Patch the select chevron SVG stroke colour to match new primary
    content = content.replace(
        /stroke='%23[a-f0-9]{6}'/gi,
        "stroke='%233BC3BD'"
    );

    // 7. Fix header-actions semi-transparent bg to use sidebar colour
    content = content.replace(
        /background:\s*rgba\(12,\s*55,\s*72,\s*0\.\d\)/g,
        'background: rgba(12, 26, 34, 0.85)'
    );

    fs.writeFileSync(filePath, content, 'utf8');
    console.log(`✅  ${file}`);
}

console.log('\nDone! All palette variables and hardcoded colours updated.');
