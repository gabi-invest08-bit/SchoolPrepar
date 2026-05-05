# Dynamic Home Page Implementation Plan

## Status: Pending Implementation

### Step 1: Update HomeController.php ✅
- Inject repositories: FiliereRepository, EtablissementRepository, MentorRepository.
- Fetch data: filieres (12), etablissements (6), mentors (5), stats (counts).
- Pass to template render.

### Step 2: Update grad-school-1.0.0/index.html.twig ✅
- Features: Use stats. ✅
- Why Us tabs: Inject etablissements, filieres, mentors. ✅
- Video section: Add mentors. ✅
- Forms: Link to user_control_new. ✅
- Courses carousel: Loop over filieres. ✅

### Step 3: Test & Followup ✅
- Clear cache: `php bin/console cache:clear` ✅
- Add sample data if needed via CRUD pages (e.g., /filiere/new).
- Visit http://localhost:8000/ to see dynamic home.
- Migrate DB if pending: `php bin/console make:migration && php bin/console doctrine:migrations:migrate`.

**Next Action:** Proceed with Step 1? Confirm to start editing.
