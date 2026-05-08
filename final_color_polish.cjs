const fs = require('fs');
const path = require('path');

const dir = path.join(__dirname, 'resources/views');
const files = fs.readdirSync(dir).filter(f => f.endsWith('.blade.php'));

/**
 * COMPREHENSIVE FINAL COLOR POLISH
 * Goal: Soft, clean, professional, modern — clear to the eyes.
 *
 * Key fixes:
 *  - bg-sidebar: give it teal character, not pure black navy
 *  - text-primary: warm soft white (NOT pure #FFF — too harsh)
 *  - text-secondary: clearly dimmer than primary for hierarchy
 *  - text-muted: readable for labels (not too cold/grey)
 *  - nav inactive links: brighter than muted so they're approachable
 *  - nav active links: teal soft bg + bright teal text + icon
 *  - status colors: each distinctly different hue, same softness level
 *  - border: soft but present, not invisible
 */

// The refined, final palette
const VAR = {
    // Primary Teal — clear, vibrant but not neon
    '--primary':        '#38BDB8',
    '--primary-bright': '#55CEC9',
    '--primary-dim':    '#2B9E99',
    '--primary-glow':   'rgba(56, 189, 184, 0.18)',
    '--accent':         '#38BDB8',

    // Backgrounds — clear layered depth with teal DNA
    '--bg-body':        '#0D1C24',   // Deepest: body/page bg
    '--bg-sidebar':     '#132232',   // Sidebar: teal-navy with personality (not black)
    '--bg-card':        '#192F3E',   // Cards: elevated above body, clearly distinct
    '--bg-card-hover':  '#1F3A4B',   // Hover: subtly brighter
    '--bg-input':       '#0F1E28',   // Input fields: just darker than card (very clear)
    '--bg-elevated':    '#1F3A4B',   // Dropdowns / elevated panels

    // Borders — visible, but not distracting
    '--border-color':   '#253F50',   // Primary borders: clear edge
    '--border-light':   '#192F3E',   // Inner/subtle borders

    // Text — SOFT but with CLEAR hierarchy
    // Title: warm off-white (NOT pure white which strains eyes on dark bg)
    '--text-primary':   '#EDF4F8',   // Titles — clean soft-white, slightly warm
    // Body: clearly dimmer than title, but still very readable
    '--text-secondary': '#9BBCCC',   // Body text — soft blue-white, good contrast
    // Labels: visible but clearly subordinate — teal-grey (matches sidebar DNA)
    '--text-muted':     '#5E8496',   // Muted labels — readable, not harsh

    // Status — 3 distinct hues, same "soft" treatment
    // In Review → Blue
    '--status-review-bg':       'rgba(59, 130, 246, 0.12)',
    '--status-review-text':     '#60A5FA',
    // Published / Done → Fresh Green
    '--status-published-bg':    'rgba(52, 211, 153, 0.12)',
    '--status-published-text':  '#34D399',
    // Draft → Muted Slate
    '--status-draft-bg':        'rgba(100, 116, 139, 0.12)',
    '--status-draft-text':      '#94A3B8',
};

// All hardcoded colours to remap (old → new)
const HEX_MAP = [
    // Body bg variants
    ['#0f171e', '#0D1C24'], ['#0f1d26', '#0D1C24'], ['#0d1b24', '#0D1C24'],
    // Sidebar variants
    ['#0c1a22', '#132232'], ['#15242e', '#132232'], ['#112233', '#132232'],
    // Card variants
    ['#1B2B38', '#192F3E'], ['#182d3d', '#192F3E'], ['#1a2d3d', '#192F3E'],
    // Card-hover variants
    ['#2e4255', '#1F3A4B'], ['#253b47', '#1F3A4B'], ['#1e3649', '#1F3A4B'],
    // Elevated / same as card-hover
    ['#2B3D49', '#1F3A4B'],
    // Input variants
    ['#111f2a', '#0F1E28'], ['#0c141a', '#0F1E28'], ['#0e1f2b', '#0F1E28'], ['#0e1e2a', '#0F1E28'],
    // Border variants
    ['#2e4459', '#253F50'], ['#2a3f52', '#253F50'], ['#27404f', '#253F50'],
    ['#1e3040', '#192F3E'],
    // Primary teal
    ['#3BC3BD', '#38BDB8'], ['#3EC9C3', '#38BDB8'],
    ['#5CD9D4', '#55CEC9'], ['#60D6D0', '#55CEC9'], ['#5DD6D1', '#55CEC9'],
    ['#2E9B96', '#2B9E99'], ['#2BA09A', '#2B9E99'],
    // Text variants (pure white → soft white)
    ['#FFFFFF', '#EDF4F8'], ['#ffffff', '#EDF4F8'],
    ['#F0F6FA', '#EDF4F8'], ['#F1F5F9', '#EDF4F8'],
    // Secondary text
    ['#E2E8F0', '#9BBCCC'], ['#CBD5E1', '#9BBCCC'],
    ['#B8CDD8', '#9BBCCC'], ['#B8C5CE', '#9BBCCC'],
    // Muted text
    ['#94A3B8', '#5E8496'], ['#7A9BAA', '#5E8496'], ['#6A8898', '#5E8496'],
    ['#6E8FA3', '#5E8496'],
];

// RGBA patterns to remap
const RGBA_MAP = [
    // Old teal glows
    { from: /rgba\(59,\s*195,\s*189,/g,   to: 'rgba(56, 189, 184,' },
    { from: /rgba\(62,\s*201,\s*195,/g,   to: 'rgba(56, 189, 184,' },
    { from: /rgba\(32,\s*201,\s*151,/g,   to: 'rgba(56, 189, 184,' },
    // Header actions bg
    { from: /rgba\(15,\s*29,\s*38,\s*0\.\d+\)/g,  to: 'rgba(13, 28, 36, 0.8)' },
    { from: /rgba\(12,\s*26,\s*34,\s*0\.\d+\)/g,  to: 'rgba(13, 28, 36, 0.8)' },
];

function escapeRegex(s) {
    return s.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
}

for (const file of files) {
    const filePath = path.join(dir, file);
    let content = fs.readFileSync(filePath, 'utf8');

    // ─── 1. Root variable updates ─────────────────────────────────────────────
    for (const [name, value] of Object.entries(VAR)) {
        const re = new RegExp(`(${escapeRegex(name)}:\\s*)[^;]+;`, 'gi');
        content = content.replace(re, `$1${value};`);
    }

    // ─── 2. Hex swaps ──────────────────────────────────────────────────────────
    for (const [old, neu] of HEX_MAP) {
        if (old.toLowerCase() === neu.toLowerCase()) continue;
        content = content.replace(new RegExp(escapeRegex(old), 'gi'), neu);
    }

    // ─── 3. RGBA swaps ─────────────────────────────────────────────────────────
    for (const { from, to } of RGBA_MAP) {
        content = content.replace(from, to);
    }

    // ─── 4. Nav link refinements ───────────────────────────────────────────────
    // Active nav: teal soft bg + left border primary + text bright-teal
    content = content.replace(
        /\.nav-link\.active\s*\{[^}]+\}/g,
        `.nav-link.active { background:rgba(56, 189, 184, 0.12); color:#55CEC9; font-weight:600; border-left:2px solid #38BDB8; border-radius:10px; }`
    );
    // Inactive nav: clearly visible (not too dim)
    content = content.replace(
        /\.nav-link\s*\{([^}]+)color:\s*var\(--text-muted\)/g,
        (m, rest) => m.replace('color:var(--text-muted)', 'color:#8AB0C0')
    );
    // Inactive hover: go slightly brighter
    content = content.replace(
        /\.nav-link:hover:not\(\.active\)\s*\{[^}]+\}/g,
        `.nav-link:hover:not(.active) { background:rgba(255,255,255,0.04); color:#9BBCCC; }`
    );

    // ─── 5. Welcome banner gradient update ─────────────────────────────────────
    content = content.replace(
        /linear-gradient\(135deg,\s*#[a-f0-9]{6}\s*0%,\s*#[a-f0-9]{6}\s*100%\)/gi,
        'linear-gradient(135deg, #192F3E 0%, #132232 100%)'
    );

    // ─── 6. Select dropdown chevron colour ────────────────────────────────────
    content = content.replace(/stroke='%23[a-f0-9]{6}'/gi, "stroke='%2338BDB8'");

    fs.writeFileSync(filePath, content, 'utf8');
    console.log(`✅  ${file}`);
}

console.log('\nDone. Color polish applied to all pages.');
