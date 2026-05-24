const fs = require('fs');
const path = require('path');

const dir = path.join(__dirname, 'resources/views');
const files = fs.readdirSync(dir).filter(f => f.endsWith('.blade.php'));

const theme = {
    primary:        '#3BC3BD',
    primaryBright:  '#5CD9D4',
    primaryDim:     '#2E9B96',
    primaryGlow:    'rgba(59, 195, 189, 0.15)',
    accent:         '#3BC3BD',
    bgBody:         '#0C3748',
    bgSidebar:      '#1B2B38',
    bgCard:         '#2B3D49',
    bgCardHover:    '#475D68',
    bgInput:        '#1B2B38',
    bgElevated:     '#475D68',
    borderColor:    '#475D68',
    borderLight:    '#2B3D49',
    textPrimary:    '#F1F5F9',
    textSecondary:  '#CBD5E1',
    textMuted:      '#94A3B8',
    statusReviewBg: 'rgba(59, 195, 189, 0.1)',
    statusReviewText: '#3BC3BD',
    statusPublishedBg: 'rgba(59, 195, 189, 0.2)',
    statusPublishedText: '#5CD9D4',
    statusDraftBg: 'rgba(71, 93, 104, 0.2)',
    statusDraftText: '#94A3B8'
};

const oldColors = [
    '#8B5CF6', '#A78BFA', '#6D28D9', '#15131E', '#1E1B2E', '#231F36', '#2D2845', '#1B1829', '#342E4A',
    '#20c997', '#34d399', '#059669', '#0a161d', '#10212b', '#142733', '#1c3444', '#26404c',
    '#121e26', '#1b2d36', '#0d141a', '#7ba19d', '#4a626b'
];

for (const file of files) {
    const filePath = path.join(dir, file);
    let content = fs.readFileSync(filePath, 'utf8');

    // 1. Force Update :root Variables
    content = content.replace(/--primary:\s*[^;]+;/gi, `--primary:        ${theme.primary};`);
    content = content.replace(/--primary-bright:\s*[^;]+;/gi, `--primary-bright: ${theme.primaryBright};`);
    content = content.replace(/--primary-dim:\s*[^;]+;/gi, `--primary-dim:    ${theme.primaryDim};`);
    content = content.replace(/--primary-glow:\s*[^;]+;/gi, `--primary-glow:   ${theme.primaryGlow};`);
    content = content.replace(/--accent:\s*[^;]+;/gi, `--accent:         ${theme.accent};`);
    content = content.replace(/--bg-body:\s*[^;]+;/gi, `--bg-body:        ${theme.bgBody};`);
    content = content.replace(/--bg-sidebar:\s*[^;]+;/gi, `--bg-sidebar:     ${theme.bgSidebar};`);
    content = content.replace(/--bg-card:\s*[^;]+;/gi, `--bg-card:        ${theme.bgCard};`);
    content = content.replace(/--bg-card-hover:\s*[^;]+;/gi, `--bg-card-hover:  ${theme.bgCardHover};`);
    content = content.replace(/--bg-input:\s*[^;]+;/gi, `--bg-input:       ${theme.bgInput};`);
    content = content.replace(/--bg-elevated:\s*[^;]+;/gi, `--bg-elevated:    ${theme.bgElevated};`);
    content = content.replace(/--border-color:\s*[^;]+;/gi, `--border-color:   ${theme.borderColor};`);
    content = content.replace(/--border-light:\s*[^;]+;/gi, `--border-light:   ${theme.borderLight};`);
    content = content.replace(/--text-primary:\s*[^;]+;/gi, `--text-primary:   ${theme.textPrimary};`);
    content = content.replace(/--text-secondary:\s*[^;]+;/gi, `--text-secondary: ${theme.textSecondary};`);
    content = content.replace(/--text-muted:\s*[^;]+;/gi, `--text-muted:     ${theme.textMuted};`);
    
    // 2. Status Badges
    content = content.replace(/--status-review-bg:\s*[^;]+;/gi, `--status-review-bg:      ${theme.statusReviewBg};`);
    content = content.replace(/--status-review-text:\s*[^;]+;/gi, `--status-review-text:    ${theme.statusReviewText};`);
    content = content.replace(/--status-published-bg:\s*[^;]+;/gi, `--status-published-bg:   ${theme.statusPublishedBg};`);
    content = content.replace(/--status-published-text:\s*[^;]+;/gi, `--status-published-text: ${theme.statusPublishedText};`);
    content = content.replace(/--status-draft-bg:\s*[^;]+;/gi, `--status-draft-bg:       ${theme.statusDraftBg};`);
    content = content.replace(/--status-draft-text:\s*[^;]+;/gi, `--status-draft-text:     ${theme.statusDraftText};`);

    // 3. Global Color Swaps (Very aggressive)
    // Replace any of the old primary colors with the new one
    content = content.replace(/#8B5CF6|#20c997|#7ba19d/gi, theme.primary);
    content = content.replace(/#A78BFA|#34d399|#9dc2c0/gi, theme.primaryBright);
    content = content.replace(/#6D28D9|#059669|#5a7a78/gi, theme.primaryDim);
    
    // Replace any of the old background colors
    content = content.replace(/#15131E|#0a161d|#121e26/gi, theme.bgBody);
    content = content.replace(/#1E1B2E|#10212b|#1b2d36/gi, theme.bgSidebar);
    content = content.replace(/#231F36|#142733|#2b3d49/gi, theme.bgCard);
    content = content.replace(/#2D2845|#1c3444|#253b47/gi, theme.bgCardHover);
    content = content.replace(/#342E4A|#26404c|#2d414a/gi, theme.borderColor);

    // 4. RGBA Swaps
    content = content.replace(/rgba\(139,\s*92,\s*246/g, 'rgba(59, 195, 189');
    content = content.replace(/rgba\(32,\s*201,\s*151/g, 'rgba(59, 195, 189');
    content = content.replace(/rgba\(123,\s*161,\s*157/g, 'rgba(59, 195, 189');
    
    // Banner background and glass effects
    content = content.replace(/linear-gradient\(135deg,\s*#[a-f0-9]{6}\s*0%,\s*#[a-f0-9]{6}\s*100%\)/gi, (match) => {
        if (match.includes('welcome-section') || true) { // Usually for banners
            return `linear-gradient(135deg, ${theme.bgCardHover} 0%, ${theme.bgSidebar} 100%)`;
        }
        return match;
    });
    
    // Specific hardcoded ones for header actions
    content = content.replace(/rgba\(16,\s*33,\s*43,\s*0\.6\)|rgba\(13,\s*20,\s*26,\s*0\.6\)|rgba\(30,\s*27,\s*46,\s*0\.6\)/g, 'rgba(12, 55, 72, 0.6)');

    fs.writeFileSync(filePath, content, 'utf8');
    console.log(`Updated ${file}`);
}
